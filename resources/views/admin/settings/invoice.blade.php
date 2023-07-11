@extends('layout.mainlayout_admin')
@section('title', 'Invoice Settings')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="page-title">Invoice Settings</h3>
                </div>
            </div>
        </div>

        <div class="tab-content pt-8">
            <div class="d-flex gap-3 justify-content-between">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body pt-0">
                            <div class="card-header">
                                <h5 class="card-title"></h5>
                            </div>
                            <form method="POST" action="{{ route('invoice-settings') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="settings-form">
                                    <div class="form-group">
                                        <label for="vat">VAT <small>(Persentage)</small>  <span class="star-red">*</span></label>
                                        <input type="number" name="vat" class="form-control" value="{{old('vat', $invoiceSettings->get("vat"))}}"
                                                placeholder="Enter VAT on Invoice" min="0" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="footer_text">Footer Text  <span class="star-red">*</span></label>
                                        <textarea name="footer_text" class="form-control" placeholder="Enter Footer Text">{{old('footer_text', $invoiceSettings->get("footer_text"))}}</textarea>
                                    </div>

                                    <div class="form-group mb-0">
                                        <div class="settings-btns">
                                            <button type="submit" class="btn btn-primary btn-add">Update</button>
                                            <a class="btn btn-danger btn-cancel">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
