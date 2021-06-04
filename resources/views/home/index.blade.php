@include('_partials/head')

<body>
   <!-- Page Content -->
  <div class="container">

    <div class="row">
      <div class="col-lg-12">

        <div class="mb-5">
        </div>
        <div class="row">
          <div class="col-lg-2">
            <select class="custom-select custom-select-sm sort-by-category">
              <option value="">Kategori</option>
              @foreach($cat as $c)
              <option value="{{$c->id}}" {{ (isset($input['category']) && $input['category'] == $c->id) ? 'selected' : '' }}>{{$c->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-lg-2">
            <select class="custom-select custom-select-sm">
              <option selected>Open this select menu</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </div>
          <div class="col-lg-2">
            <div class="form-group">
              <a href="{{ route('page_update', 0) }}"><button type="button" class="btn btn-secondary">Tambah Produk</button></a>
            </div>
          </div>
          <div class="col-lg-2">
            <div class="form-group">
              <a href="{{route('exportXML')}}"><button type="button" class="btn btn-secondary">Export XML</button></a>
            </div>
          </div>
          <div class="col-lg-2">
            <div class="form-group">
              <button type="button" class="btn btn-secondary" id="btnexcel">Export Excel</button>
            </div>
          </div>
        </div>
        <div class="mb-5">
        </div>
        <div class="row">
          @foreach($db as $d)
          <div class="col-lg-3 col-md-4 mb-4">
            <div class="card h-100">
              <a href=""><img class="card-img-top" src="{{ $d->preview }}" alt="" width="400px" height="200px"></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a style="color: #343a40 !important; text-decoration-line: none;" href="">{{ $d->title }}</a>
                </h4>
                <h5>{{ $d->price }} 
                  <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                      <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                    </svg>
                  </span>
                  <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-archive-fill" viewBox="0 0 16 16">
                    <path d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15h9.286zM5.5 7h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zM.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8H.8z"/>
                  </svg>
                  </span>
                </h5>

              </div>
            </div>
          </div>
          @endforeach

          <table class="table" id="exportcel" style="display: none;">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
              @foreach($db as $d)
                <tr>
                  <td>{{ $d->title }}</td>
                  <td>{{ $d->price }}</td>
                </tr>
              @endforeach
            </tbody> 
        </table>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->
@include('_partials/footer')
