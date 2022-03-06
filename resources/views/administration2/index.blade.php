@extends('layouts.admin')

@section('style')
<style>
    th, td
    {
        text-align: center;
        vertical-align: middle;
    }
    .switch {
  position: relative;
  display: inline-block;
  width: 30px;
  height: 12px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 12px;
  width: 12px;
  left: -6px;
  bottom: 0px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

</style>
@endsection

@section('content')


  <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
		    <div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-2 border-right">
		                    <h4>Condidats</h4>
		                </div>
		                
		            </div>
		            <div class="row">
		                <div class="col-md-12">
		                    <table class="table table-hover ">
                                <thead class="bg-light ">
                                    <th>ID</th>
                                    <th>Langue</th>
                                    <th>Statut</th>
                                    <th>Formulaire</th>
                                    <th>Date de création</th>
                                    <th>Actions</th>
                                </thead>
                                @foreach($users as $row)
                                <tbody>
                                    <td><small>{{ $row['id']}}</small></td>
                                    <td>
                                        @if($row->lang==0)
                                        Arabe
                                        @else
                                        <small>Français</small>
                                        @endif
                                    </td>
                                    <td><small>
                                    @if($row->is_active==1)
                                    <b style="color:green;">Active</b>
                                    @else
                                    <b style="color:red;">Inactive</b>
                                    @endif
                                    </small></td>
                                    <td>
                                        @if($row->provider==1)
                                        <i class="fa fa-check-circle-o" style="color: green"></i>
                                        @else
                                        <i class="fa fa-times-circle-o" style="color: red"></i>
                                        @endif
                                    </td>
                                    <td><small>{{ date('j M Y  H:i:s', strtotime($row->created_at)) }}</small></td>
                                    <td>
                                        <a href="/administration2/{{$row['id']}}" title="Details"><i class="fa fa-eye"></i></a>
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