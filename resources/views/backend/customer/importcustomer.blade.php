@extends('admin.adminmaster')

@section('admincontent')
<div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Customer Import</h4>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Import</h4>
                                        <div class="errors">
                                        @if($errors->any())
                                            @foreach ($errors->all() as $error)
                                                <div>{{ $error }}</div>
                                            @endforeach
                                        @endif
                                        </div>
                                        <form action="{{ route('customerimportprocess') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                            <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="customercsv" class="form-label">Upload File</label>
                                                                        <input class="form-control" type="file" id="customercsv" name="customercsv" required>
                                                                    </div>
                                                            </div>   
                                                            
                                                        </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                            <div>
                                                <button type="submit" class="btn btn-primary w-md">Submit</button>
                                            </div>
                                                    </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
        
</div>
@endsection