@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    
        <section class="section">
          <div class="section-header">
            <h1>Blog</h1>
          </div>

          <div class="section-body">
           
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>All Blogs</h4>
                    <div class="card-header-action">
                        <a href="{{route('admin.blog.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Create new</a>
                    </div>
                  </div>
                  <div class="card-body">
                      {{$dataTable->table()}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        
@endsection

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}

  <script>
    $(document).ready(function(){
      $('body').on('click', '.change-status', function(){
        let isChecked = $(this).is(':checked');
        let id = $(this).data('id');

        $.ajax({
          url:"{{route('admin.blog.change-status')}}" ,
          method: 'PUT',
          data: {
            status : isChecked,
            id: id
          }, 
          success: function(data){
            toastr.success(data.message);
            setTimeout(function(){
              window.location.reload();
            }, 1500);
          },
          error: function(xhr, status, error){
            console.log(error);
          }
        })
      })
    })
  </script>

@endpush