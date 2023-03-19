@extends('admin.adminmaster')
@section('admincontent')

<div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Quotes</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                @if(!$quotelist->isEmpty())
                
                
                     <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th style="font-weight: bold;">ID</th>
                                <th style="font-weight: bold;">Name</th>
                                <th style="font-weight: bold;">Items</th>
                                <th style="font-weight: bold;">Date</th>
                                <th style="font-weight: bold;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quotelist as $quote)
                                <tr>
                                    <td>{{$quote->quoteno}}</td>
                                    <td>{{$quote->firstname}} {{$quote->lastname}}</td>
                                    <td>
                                        @foreach($quoteitems as $quoteitem)
                                            @if($quoteitem->quoteid==$quote->id)
                                            {{$quoteitem->productname}}<br/>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $quote->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <a href="{{ route('adminmyquotedetail',$quote->id) }}" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-pencil font-size-18"></i></a>
                                            <a href="{{ route('deletequote',$quote->id) }}" class="btn btn-danger waves-effect waves-light deleteaction"><i class="mdi mdi-delete font-size-18"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                
                            @endforeach
                            
                        </tbody>
                    </table>
               
                @else
                    <span class="quotes">
                        No quote request available.
                    </span>
               @endif
               
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            
                        </div> <!-- end row -->
        
                         </div>
      
@endsection