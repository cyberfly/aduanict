<script type="text/javascript">

    $( document ).ready(function() {

        //show js clock

        var servertime = parseFloat( $("#servertime").val() ) * 1000;

        $("#clock").clock({
            "timestamp":servertime,
            "calendar":'false',
        });

        //when validation error, hide_by_category need to process again

        var complain_category_id = $("#complain_category_id").val();
        show_hide_by_category(complain_category_id);

        //when validation error, check bagi pihak and show user dropdown if Yes

        var bagi_pihak = $('#bagi_pihak:checked').val();
        if(bagi_pihak=='Y')
        {
            $('#pilih_bagi_pihak').show();
        }

        //when click bagi_pihak, show or hide user dropdown

        $("#bagi_pihak").change(function() {

            if ($(this).prop("checked")) {
                $('#pilih_bagi_pihak').fadeIn(500);
            }
            else
            {
                $('#pilih_bagi_pihak').fadeOut(500);
            }

        });

        //when change category

        $( "#complain_category_id" ).change(function() {

            var complain_category_id = $(this).val();
            show_hide_by_category(complain_category_id);

            //reset kaedah

            $("#complain_source_id").val('');
            $("#complain_source_id").trigger("chosen:updated");

        });


        //dapatkan current value branch_id, by input ID

        $( "#branch_id" ).change(function() {

            var branch_id = $(this).val();
            get_locations_by_branch(branch_id);

        });

        $( "#lokasi_id" ).change(function() {

            var lokasi_id = $(this).val();
            get_assets_by_location(lokasi_id);

        });

        function show_hide_by_category(complain_category_id)
        {
            //if not kategori selected, just exit the function
            if(!complain_category_id)
            {
                return;
            }

            //if zakat2u and zakat portal, hide branch, location and asset

            var exp_complain_category_id = complain_category_id.split('-');

            complain_category_id = exp_complain_category_id[0];

            if(complain_category_id==5||complain_category_id==6)
            {
                $('.hide_by_category').hide();
            }
            else{
                $('.hide_by_category').show();
            }
        }

        function get_locations_by_branch(branch_id)
        {

            $.ajax({
                type: "GET",
                url: base_url + '/complain/locations',
                dataType: "json",
                data:
                {
                    branch_id : branch_id
                },
                beforeSend: function() {

                },
                success: function (location_data) {

                    //empty current dropdown option

                    $("#lokasi_id").empty();

                    //create a new dropdown option using the data provided by json object

                    $.each(location_data, function(key, value) {
                        $("#lokasi_id").append("<option value='"+ key +"'>" + value + "</option>");
                    });

                    //reinitiliaze chosen dropdown with new value

                    $("#lokasi_id").val('');
                    $("#lokasi_id").trigger("chosen:updated");




                }
            });


        }

        function get_assets_by_location(lokasi_id)
        {

            $.ajax({
                type: "GET",
                url: base_url + '/complain/assets',
                dataType: "json",
                data:
                {
                    lokasi_id : lokasi_id
                },
                beforeSend: function() {

                },
                success: function (assets_data) {

                    //empty current dropdown option

                    $("#ict_no").empty();

                    //create a new dropdown option using the data provided by json object

                    $.each(assets_data, function(key, value) {
                        $("#ict_no").append("<option value='"+ key +"'>" + value + "</option>");
                    });

                    //reinitiliaze chosen dropdown with new value

                    $("#ict_no").val('');
                    $("#ict_no").trigger("chosen:updated");



                }
            });


        }

    });

</script>