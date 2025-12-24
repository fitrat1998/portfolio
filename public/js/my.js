// students-table.js
// Bitta DataTable init, real-time filterlar (select change + debounced text inputs)

$(function () {
    // quick guards
    if (typeof $.fn.dataTable !== 'function') {
        return console.error('DataTables not loaded');
    }
    if (!document.getElementsByClassName('.myTable')) {
        return console.error('#myTable not found in DOM');
    }

    // debounce helper
    function debounce(fn, wait) {
        var t;
        return function () {
            var ctx = this, args = arguments;
            clearTimeout(t);
            t = setTimeout(function () {
                fn.apply(ctx, args);
            }, wait);
        };
    }

    // helperlar select larni to'ldirish / reset qilish uchun
    function resetSelect($el, placeholder) {
        $el.empty().append($('<option>', {value: '', text: placeholder}));
        $el.val('').trigger('change');
        $el.prop('disabled', true);
    }

    function fillSelect($el, items, placeholder) {
        $el.empty().append($('<option>', {value: '', text: placeholder}));
        (items || []).forEach(function (it) {
            $el.append($('<option>', {value: it.id, text: it.name}));
        });
        $el.prop('disabled', false).val('').trigger('change');
    }

    // DataTable init (server-side)
    var table = $('#myTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        lengthChange: true,
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        autoWidth: true,
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        ajax: {
            url: '/students/datatable',
            data: function (d) {
                // send all filter values to backend
                d.faculty = $('#faculty_id').val();
                d.direction = $('#direction_id').val();
                d.group = $('#group_id').val();
                d.course = $('#course_id').val();

                // optional text filters (add inputs in your HTML if needed)
                d.first_name = $('#first_name').val();
                d.student_id_number = $('#student_id_number').val();
                d.min_gpa = $('#min_gpa').val();
            }
        },
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        columns: [
            {data: 'student_id_number'},
            {
                data: 'full_name',
                render: function (data, type, row) {
                    return `<a href="/students/${row.student_id_number}" class="text-dark">${data}</a>`;
                }
            },
            {
                data: 'is_graduate',
                render: function (data) {
                    return data ? 'Ha' : "Yo'q";
                }
            },
            {data: 'department.name'},
            {data: 'specialty.name'},
            {data: 'paymentForm.name'},
            {data: 'educationYear.name'},
            {data: 'educationForm.name'},
            {data: 'semester.name'},
            {data: 'group.name'},
            {data: 'avg_gpa'},
            {
                data: 'updated_at',
                render: function (data) {
                    if (!data) return '';
                    var ts = data;
                    if (typeof ts === 'number' && ts < 1e12) ts = ts * 1000; // seconds -> ms
                    return new Date(ts).toLocaleDateString();
                }
            }
        ]
    });

    // SELECT change handlers (immediate reload)
    // Helper: selectni to'ldiradi va faollashtiradi
    function fillSelect($select, items, placeholder) {
        var placeholderText = placeholder || 'Tanlang';
        var options = '<option value="">' + placeholderText + '</option>';
        items.forEach(function (it) {
            options += '<option value="' + it.id + '">' + it.text + '</option>';
        });
        $select.html(options).prop('disabled', false);
    }


    $('#region_id').on('change', function () {
        let did = $(this).val();

        $('#area_id')
            .prop('disabled', true)
            .html('<option>Yuklanmoqda...</option>');

        $.ajax({
            url: '/areas/' + did,
            method: 'GET',
            dataType: 'json',
            success: function (resp) {


                console.log(resp)

                let options = null;

                resp.forEach(item => {
                    options += `<option value="${item.id}">${item.area_name}</option>`;
                });

                $('#area_id')
                    .html(options)
                    .prop('disabled', false);
            },
            error: function () {
                alert('Hududlarni yuklashda xato.');
            }
        });
    });


    $('#area_id').on('change', function () {
        table.ajax.reload();
    });

    // course change: optionally fetch related data, then reload
    $('#course_id').on('change', function () {
        var courseId = $(this).val();
        var facultyId = $('#faculty_id').val();
        var directionId = $('#direction_id').val();
        var groupId = $('#group_id').val();

        if (!courseId) {
            table.ajax.reload();
            return;
        }

        $.getJSON('/groups/' + courseId + '/courses', {
            faculty_id: facultyId,
            direction_id: directionId,
            group_id: groupId
        })
            .done(function (resp) {
                // if you need to populate other selects from resp, do it here:
                // var items = resp?.data?.items ?? [];
                // fillSelect($('#group_id'), items, 'Hududni tanlang');

                // reload with course filter
                table.ajax.reload();
            })
            .fail(function () {
                alert('Kurslarni yuklashda xato.');
            });
    });

    // TEXT inputs — debounced real-time filtering
    var debouncedReload = debounce(function () {
        table.ajax.reload();
    }, 300);
    $('#student_search, #first_name, #student_id_number, #min_gpa').on('input', debouncedReload);

});

function togglePassword(id, icon) {
    const input = document.getElementById(id);
    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';
    icon.textContent = isHidden ? '🕶️' : '👁️';
}

function checkPasswordMatch() {
    const password = document.getElementById('password').value;
    const confirm = document.getElementById('password_confirmation').value;
    const success = document.getElementById('password-match-success');
    const error = document.getElementById('password-match-error');

    if (!confirm) {
        success.style.display = 'none';
        error.style.display = 'none';
        return;
    }

    if (password === confirm) {
        success.style.display = 'block';
        error.style.display = 'none';
    } else {
        success.style.display = 'none';
        error.style.display = 'block';
    }
}

//end of toogle password
document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.querySelector('[data-sidebar-toggle]');
    const wrapper = document.getElementById('admin-wrapper');

    if (toggleButton && wrapper) {
        const isCollapsed = localStorage.getItem('sidebar-collapsed') === 'true';
        if (isCollapsed) {
            wrapper.classList.add('sidebar-collapsed');
            toggleButton.classList.add('is-active');
        }

        toggleButton.addEventListener('click', () => {
            const isCurrentlyCollapsed = wrapper.classList.contains('sidebar-collapsed');

            if (isCurrentlyCollapsed) {
                wrapper.classList.remove('sidebar-collapsed');
                toggleButton.classList.remove('is-active');
                localStorage.setItem('sidebar-collapsed', 'false');
            } else {
                wrapper.classList.add('sidebar-collapsed');
                toggleButton.classList.add('is-active');
                localStorage.setItem('sidebar-collapsed', 'true');
            }
        });
    }
});
//end of sidebar collapse

$('select.duallistbox').each(function () {
    $(this).bootstrapDualListbox({
        // nonSelectedListLabel: $(this).data('label-left') || 'Mavjud',
        // selectedListLabel: $(this).data('label-right') || 'Tanlangan',
        filterPlaceHolder: $(this).data('placeholder') || 'Qidirish...',
        infoText: $(this).data('info-text') || 'Jami {0} ta',
        infoTextEmpty: $(this).data('info-empty') || 'Bo‘sh',
        infoTextFiltered: $(this).data('info-filtered') || '<span class="label label-warning">Filtrlangan</span> {0} dan {1}',
    });
});

//end of duallistbox


(function () {
    const zone = document.getElementById('simpleUploadZone');
    const input = document.getElementById('simpleFileInput');
    const list = document.getElementById('simpleFileList');
    const zoneText = document.getElementById('uploadZoneText');
    const MAX_BYTES = 10 * 1024 * 1024; // 10MB

    function formatBytes(bytes) {
        if (bytes === 0) return '0 B';
        const k = 1024, sizes = ['B', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    function renderFile(file) {
        list.innerHTML = '';
        if (!file) return;
        const item = document.createElement('div');
        item.className = 'list-group-item d-flex justify-content-between align-items-center';

        const left = document.createElement('div');
        left.className = 'd-flex align-items-center';
        left.innerHTML = `<i class="bi bi-file-earmark me-3 text-primary"></i>
                          <div>
                            <div class="fw-medium">${escapeHtml(file.name)}</div>
                            <small class="text-muted">${formatBytes(file.size)}</small>
                          </div>`;

        const right = document.createElement('div');

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'btn btn-sm btn-outline-danger';
        removeBtn.innerHTML = '<i class="bi bi-trash"></i>';
        removeBtn.addEventListener('click', function () {
            input.value = '';
            list.innerHTML = '';
            zoneText.textContent = 'Faylni bu yerga tashlang yoki bosing';
        });

        right.appendChild(removeBtn);
        item.appendChild(left);
        item.appendChild(right);
        list.appendChild(item);
    }

    function escapeHtml(text) {
        return text.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;").replace(/'/g, "&#039;");
    }

    zone.addEventListener('click', () => input.click());

    zone.addEventListener('dragover', (e) => {
        e.preventDefault();
        zone.classList.add('border-primary');
        zone.style.background = '#f8fbff';
    });

    zone.addEventListener('dragleave', (e) => {
        e.preventDefault();
        zone.classList.remove('border-primary');
        zone.style.background = '';
    });

    zone.addEventListener('drop', (e) => {
        e.preventDefault();
        zone.classList.remove('border-primary');
        zone.style.background = '';
        const files = e.dataTransfer.files;
        if (!files || files.length === 0) return;
        handleSelectedFile(files[0]);
    });

    input.addEventListener('change', (e) => {
        if (e.target.files && e.target.files[0]) {
            handleSelectedFile(e.target.files[0]);
        }
    });

    function handleSelectedFile(file) {
        const allowedExt = ['.pdf', '.doc', '.docx'];
        if (!allowedExt.some(ext => file.name.toLowerCase().endsWith(ext))) {
            alert('Faqat PDF yoki Word fayllar ruxsat etiladi.');
            input.value = '';
            return;
        }

        if (file.size > MAX_BYTES) {
            alert('Fayl juda katta. Maksimal hajm 10MB.');
            input.value = '';
            return;
        }

        // Put the file into native input so it will submit with the form
        try {
            const dt = new DataTransfer();
            dt.items.add(file);
            input.files = dt.files;
        } catch (err) {
            // Fallback: some old browsers may not support DataTransfer
            console.warn('DataTransfer ishlamadi, iltimos file picker orqali tanlang.');
        }

        zoneText.textContent = 'Tanlangan fayl: ' + file.name;
        renderFile(file);
    }
})();


document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.querySelector('[data-sidebar-toggle]');
    const wrapper = document.getElementById('admin-wrapper');

    if (toggleButton && wrapper) {
        // Set initial state from localStorage
        const isCollapsed = localStorage.getItem('sidebar-collapsed') === 'false';
        if (isCollapsed) {
            wrapper.classList.add('sidebar-collapsed');
            toggleButton.classList.add('is-active');
        }

        // Attach click listener
        toggleButton.addEventListener('click', () => {
            const isCurrentlyCollapsed = wrapper.classList.contains('sidebar-collapsed');

            if (isCurrentlyCollapsed) {
                wrapper.classList.remove('sidebar-collapsed');
                toggleButton.classList.remove('is-active');
                localStorage.setItem('sidebar-collapsed', 'false');
            } else {
                wrapper.classList.add('sidebar-collapsed');
                toggleButton.classList.add('is-active');
                localStorage.setItem('sidebar-collapsed', 'true');
            }
        });
    }
});

//



