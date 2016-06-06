$(function() {

	// Confirm an action before proceeding.
    var confirmAction = function(e) {
        var input = $(this);

        var form = input.closest('form');

        input.prop('disabled', 'disabled');

        swal({
          title: "Are you sure?",
          text: "This will update your existing data",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, update it!",
          closeOnConfirm: false
        },
        function(){
          form.submit();
        });

        input.removeAttr('disabled');
    };

	// Confirm an action before proceeding.
    var confirmDestroy = function(e) {
        var input = $(this);

        var form = input.closest('form');
        var row = input.closest('tr');

        input.prop('disabled', 'disabled');

        swal({
          title: "Anda pasti?",
          text: "Rekod ini tidak akan kembali!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Ya, padam ia!",
          cancelButtonText: "Tidak",
          closeOnConfirm: false
        },
        function(){
          form.submit();
          row.fadeOut('slow');
        });

        input.removeAttr('disabled');
    };

	var submitAjaxRequest = function(e){

		var form = $(this);
		var method = form.find('input[name="_method"]').val() || 'POST';

		$.ajax({
			url: form.prop('action'),
			type: method,
			data: form.serialize(),
			success: function(response)
			{
				swal(response.flag, response.message, response.result);

                // window.location = response.redirecturl;

			}
		});

		e.preventDefault();

	};

	$('input[data-confirm], button[data-confirm]').on('click', confirmAction);
	$('input[data-destroy], button[data-destroy]').on('click', confirmDestroy);
	$('form[data-remote]').on('submit', submitAjaxRequest);
});
