@extends('layouts.admin')

@section('style')
<style>
    th, td
    {
        text-align: center;
        vertical-align: middle;
    }
</style>
@endsection

@section('content')


  <div class="container-fluid">
	<div class="row">
		<div class="col-md-3 ">
		    <div class="list-group ">
              <a href="/administration" class="list-group-item list-group-item-action">Candidats</a>
              <a href="/administration/util/endregister" class="list-group-item list-group-item-action">Candidats qui ont rempli le formulaire</a>              
              
            </div> 
		</div>
		<div class="col-md-9">
		    <div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-6 border-right">
		                    <h4>Candidats qui ont rempli le formulaire</h4>
		                </div>
		                
		            </div>
		            <div class="row">
		                <div class="col-md-12">
		                    <table class="table table-hover ">
                                <thead class="bg-light ">
                                    <th>E-mail</th>
                                    <th>Prénom (AR)</th>
                                    <th>Nom (AR)</th>
                                    <th>Prénom (FR)</th>
                                    <th>Nom (FR)</th>
                                    <th>Type</th>
                                    <th>Statut</th>
                                    <th>Date de création</th>
                                    <th>Actions</th>
                                </thead>
                                @foreach($users as $row)
                                <tbody>
                                    <td><small>{{ $row['email']}}</small></td>
                                    <td><small>{{ $row['first_name_ar']}}</small></td>
                                    <td><small>{{ $row['last_name_ar']}}</small></td>
                                    <td><small>{{ $row['first_name_fr']}}</small></td>
                                    <td><small>{{ $row['last_name_fr']}}</small></td>
                                    <td>
                                        @if($row->type==1)
                                        Admin
                                        @else
                                        <small>User</small>
                                        @endif
                                    </td>
                                    <td><small>
                                    @if($row->is_active==1)
                                    <b style="color:green;">Active</b>
                                    @else
                                    <b style="color:red;">Inactive</b>
                                    @endif
                                    </small></td>
                                    <td><small>{{ date('j M Y  H:i:s', strtotime($row->created_at)) }}</small></td>
                                    <td>
                                        <a href="/administration/{{$row['id']}}" title="Details"><i class="fa fa-eye"></i></a>
                                        <form method="post" class="delete_form" action="{{action('UserController@destroy', $row->id)}}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="_method" value="DELETE" />
                                            <button style="background:none;border:none;font-size:1em;color:#3490dc; cursor: pointer;" type="submit" title="supprimer la filière"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tbody>
                                @endforeach
                                
                              </table>
                        </div>
                        <div class="col-md-12 d-flex justify-content-center m-t-25 m-b-25">
                            {{ $users->links() }}
                        </div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script>
        $(document).ready(function(){
         $('.delete_form').on('submit', function(){
          if(confirm("Êtes-vous sur de vouloir le supprimer?"))
          {
           return true;
          }
          else
          {
           return false;
          }
         });
        });
</script>
@endsection