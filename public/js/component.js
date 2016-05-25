

        $('#myModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var actions = button.data('tajuk') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text(actions)
            modal.find('.modal-body input').val(actions)
        })
        // end
        $('#dropD').on('shown.bs.dropdown', function () {
            confirm("Assalamualaikum");
        })
        //end
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            confirm(e.target.text) // newly activated tab
            // e.relatedTarget // previous active tab
        })
        //end
                   $('[data-toggle="tooltip"]').tooltip()
              //end
        $('#myB').on('click', function () {
            var $btn = $(this).button('loading')
            alert("Testing 123")
            //$btn.button('reset')
        })
