/**
 * LAB ASSET MANAGEMENT SYSTEM - CUSTOM FUNCTIONS
 */

$(document).ready(function() {
    // ===== INITIALIZATIONS =====
    initDatePickers();
    initDataTables();
    initFormValidations();
    initUIComponents();

    // ===== EVENT HANDLERS =====
    handleAjaxErrors();
    handlePrintButtons();
    handleStockCalculations();
});

// ==================== CORE FUNCTIONS ====================

function initDatePickers() {
    $('.datepicker').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: {
            format: 'YYYY-MM-DD'
        }
    });
}

function initDataTables() {
    $('.datatable').DataTable({
        responsive: true,
        language: {
            url: baseUrl + 'assets/plugins/datatables/i18n/id.json'
        },
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        initComplete: function() {
            $('.dataTables_filter input').addClass('form-control form-control-sm');
            $('.dataTables_length select').addClass('form-control form-control-sm');
        }
    });
}

function initFormValidations() {
    // Enable Bootstrap validation
    $('form.needs-validation').each(function() {
        $(this).on('submit', function(e) {
            if (!this.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            $(this).addClass('was-validated');
        });
    });

    // Auto-validate on change
    $('.needs-validation input').on('change', function() {
        $(this).closest('form').addClass('was-validated');
    });
}

function initUIComponents() {
    // Initialize Select2
    $('.select2').select2({
        theme: 'bootstrap4'
    });

    // Initialize Summernote
    $('.summernote').summernote({
        height: 150,
        toolbar: [
            ['style', ['bold', 'italic', 'underline']],
            ['para', ['ul', 'ol']],
            ['view', ['fullscreen']]
        ]
    });
}

// ==================== UTILITY FUNCTIONS ====================

function handleAjaxErrors() {
    $(document).ajaxError(function(event, jqxhr, settings, thrownError) {
        if (jqxhr.status === 419) {
            Swal.fire({
                icon: 'error',
                title: 'Session Expired',
                text: 'Please refresh the page and try again',
                confirmButtonText: 'Reload',
                allowOutsideClick: false
            }).then(() => {
                window.location.reload();
            });
        } else if (jqxhr.status === 403) {
            toastr.error('You are not authorized to perform this action');
        } else if (jqxhr.responseJSON && jqxhr.responseJSON.message) {
            toastr.error(jqxhr.responseJSON.message);
        }
    });
}

function handlePrintButtons() {
    $('.btn-print').on('click', function() {
        window.print();
    });
}

function handleStockCalculations() {
    $('input[name="quantity"]').on('change', function() {
        const currentStock = parseInt($('#current_stock').val()) || 0;
        const quantity = parseInt($(this).val()) || 0;
        
        if (quantity > currentStock) {
            toastr.warning('Quantity exceeds available stock');
            $(this).val(currentStock);
        }
    });
}

// ==================== GLOBAL HELPERS ====================

function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(amount);
}

function showLoading() {
    $('.preloader').fadeIn();
}

function hideLoading() {
    $('.preloader').fadeOut();
}

// Base URL helper
const baseUrl = $('meta[name="base-url"]').attr('content') || '/';

<script>
$(document).ready(function() {
    // Hapus datatable sebelumnya jika sudah ada
    if ($.fn.DataTable.isDataTable('#myTable')) {
        $('#myTable').DataTable().destroy();
    }

    // Inisialisasi ulang DataTable
    $('#myTable').DataTable({
        responsive: true,
        autoWidth: false
    });
});
</script>
