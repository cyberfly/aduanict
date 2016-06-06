@if($complain->complain_status_id==2)

    @role('unit_manager')

    <div class="alert alert-warning">
        Aduan telah diagihkan kepada staff.
    </div>

    @endrole

@elseif($complain->complain_status_id==3)

    <div class="alert alert-warning">
        Aduan menunggu pengesahan dari {{ $complain->user->name }}.
    </div>

@elseif($complain->complain_status_id==4)

    <div class="alert alert-warning">
        Aduan menunggu pengesahan dari Helpdesk.
    </div>

@elseif($complain->complain_status_id==5)

    <div class="alert alert-success">
        Aduan telah di tutup!
    </div>

@elseif($complain->complain_status_id==7)

    <div class="alert alert-success">
        Aduan dalam proses agihan!
    </div>

@endif