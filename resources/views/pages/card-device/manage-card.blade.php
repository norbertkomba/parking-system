@extends('temp.app')
@section('content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="{{ url('dashboard') }}">Home</a>
            </li>

            <li>
                <a>{{ str_replace('-',' & ',Str::title(request()->segment(1))) }}</a>
            </li>
            <li class="active">{{ str_replace('-',' ',Str::title(request()->segment(2))) }}</li>
        </ul>
    </div>

    <div class="page-content">
        @include('temp.ace-setting')
        <div class="row">
            <div class="col-sm-7">
                <div class="table-header">
                    Results for "Latest Registered {{ str_replace('-',' ',Str::title(request()->segment(2))) }}"
                </div>
                <div>
                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th class="text-left">Device Token</th>
                                <th>Card No</th>
                                <th>Card Name</th>
                                <th class="hidden"></th>
                                <th class="hidden"></th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach (\DB::select("SELECT * FROM `vehicle_cards` ORDER BY `id` DESC LIMIT 200") as $key => $c)
                                <tr>
                                    <td class="center">{{ $key+1 }}</td>
                                    <td>{{ $c->device_token }}</td>
                                    <td>{{ $c->card_no }}</td>
                                    <td>{{ $c->card_name ?? "Unknown" }}</td>
                                    <td class="hidden"></td>
                                    <td class="hidden"></td>

                                    <td class="center" width="100">
                                        <div class="action-buttons">
                                            @can('update card')
                                                <a class="green" href="{{ route('card.manage',['card'=>$c->id]) }}">
                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                </a>
                                            @endcan

                                            @can('delete card')
                                                <a class="red delete-btn" style="cursor: pointer;" data-value="{{ $c->card_name }}" data-id="vehicle_cards|{{ $c->id }}">
                                                    <i class="ace-icon fa fa-trash-o bigger-140"></i>
                                                </a>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="widget-box widget-color-blue">
                    <div class="table-header">
                        Card Details
                    </div>

                    <div class="widget-body">
                        <div class="widget-main padding-2">
                            <form id="card-device/card/cu-card" autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                                        <input type="text" class="form-control" name="card_name" value="{{ $card->card_name ?? '' }}" placeholder="Card name">
                                        <input type="hidden" name="card" value="{{ $card->id ?? '' }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                        <input type="text" class="form-control" name="card_no" value="{{ $card->card_no ?? '' }}" placeholder="Card number" disabled>
                                    </div>
                                </div>

                                @if ($card)
                                    <button type="button" class="btn btn-sm btn-primary btn-round" id="cu_card" onclick="updateOrCreateData('card-device/card/cu-card','cu_card')">
                                        <i class="fa fa-send"></i> Save
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
