@extends('layout')

@section('content')

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Caller Id</h1>

        <p>Enter numbers to be added as caller ids and manage them.</p>

        {{ Form::open(array('url'=>'/settings/caller_id/create','class'=>'form-inline')) }}
        <h3>Enter Caller ID:</h3>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="form-group">
                        <input type="text" name="area_code" class="form-control" id="area_code" placeholder="Area Code">
                    </div>
                    <div class="form-group">
                        <input type="text" name="prefix" class="form-control" id="prefix" placeholder="Prefix">
                    </div>
                    <div class="form-group">
                        <input type="text" name="number" class="form-control" id="number" placeholder="Number">
                    </div>
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                <button class="btn btn-lg btn-primary" type="submit">Add Caller ID &raquo;</button>
                </div>
            </div>
        </div>
        {{ Form::close() }}

        <br />
        <h2><font color="#ff4500">IDs</font></h2>
          <table class="table table-condensed table-striped table-bordered table-hover">
            <thead>
              <tr >
                <th>ID</th>
                <th>Area</th>
                <th>Prefix</th>
                <th>Number</th>
                <th>Status</th>
                <th>Created By</th>
                <th>Updated By</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
@foreach ($caller_ids as $c)
              <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->area_code }}</td>
                <td>{{ $c->prefix }}</td>
                <td>{{ $c->number }}</td>
                <td>{{ $c->status }}</td>
                <td>{{ $c->created_by_id }}</td>
                <td>{{ $c->updated_by_id }}</td>
                <td>{{ $c->created_at }}</td>
                <td>{{ $c->updated_at }}</td>
                <td>
                <a href="/settings/caller_id/{{ $c->id }}/edit">
                    <span class="glyphicon glyphicon-pencil" style="padding-right: 10px" title="Edit"></span>
                </a>
                <a href="/settings/caller_id/{{ $c->id }}/delete">
                    <span class="glyphicon glyphicon-trash" title="Remove"></span>
                </a>
                </td>
              </tr>
@endforeach
            </tbody>
          </table>

@stop
