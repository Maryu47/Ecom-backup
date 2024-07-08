@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    
        <section class="section">
          <div class="section-header">
            <h1>Footer</h1>
          </div>

          <div class="section-body">
           
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Create Footer Item</h4>
                    <div class="card-header-action">
                      <a href="{{route('admin.category.index')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Go back</a>
                  </div>
                  </div>
                  <div class="card-body">
                      <form action="{{route('admin.footer-grid-two.store')}}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="">
                        </div>
                        <div class="form-group">
                            <label>url</label>
                            <input type="text" class="form-control" name="url" value="">
                        </div>
                        <div class="form-group">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                              <option value="1">Active</option>
                              <option value="0">Inactive</option>
                            </select>
                          </div>
                          <button type="submit" class="btn btn-primary">Create</button>
                      </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
@endsection