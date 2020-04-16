@extends('adminLTE.layout')

@push('title')
Form Order
@endpush

@push('page-name')
Form Order
@endpush

@section('content')
<input hidden value='{!! json_encode($products) !!}' id="json-product" />
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <!-- form start -->
      <form role="form" method="POST" action="{{ route($resource.'.store') }}" >
        @csrf

        <input type="hidden" name="id" value="{{isset($data) ? $data->id:''}}" />
        
        <div class="card-body">
          <h4>Data Order</h4>
          <div class="row">


            <!-- Date Delivery -->
            <div class="form-group col-md-6">
              <label for="date_delivery">Date Delivery <span class="text-danger">*</span></label>
              <input required datepicker autocomplete="off" name="date_delivery" type="text" class="form-control" id="date_delivery" placeholder="" value="{{isset($data) ? $data->date_delivery:''}}">
            </div>
            
            <!-- Customer Id -->
            <div class="form-group col-md-6">
              <label for="customer_id">Customer <span class="text-danger">*</span></label>
              <select  required name="customer_id" id="customer_id" selectpicker class="form-control">
                <option value="">- Chosee -</option>
                @foreach ((new App\Customer)->get() as $customer)
                    <option {{isset($data) && $data->customer_id == $customer->id ? 'selected':''}} value="{{$customer->id}}">{{$customer->name}}</option>
                @endforeach
              </select>
            </div>  

            <div class="col-md-12">
              <button type="button" class="btn btn-primary btn-sm mb-2 add-product">Tambah Produk</button>
              <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th style="width: 250px">Nama Produk</th>
                  <th style="width: 100px">Harga</th>
                  <th style="width: 50px">Qty</th>
                  <th style="width: 100px">Total</th>
                  <th style="width: 60px"></th>
                </tr>
              </thead>
              @if (!isset($data))
                <tr>
                  <td colspan="6" class="text-center no-data">Tidak ada data</td>
                </tr>
              @endif
              @if (isset($data))
                @foreach ($data->detail as $key =>  $item)
                {{-- {{dd($item->toArray())}} --}}
                <tr class="row-item">
                  <input type="hidden" class="form-control" name="detail[{{$key}}][id]" value="{{$item->id}}" />
                  <td>{{$key+1}}</td>
                  <td>
                    <select selectpicker data-size=5 data-live-search="true" name="detail[{{$key}}][product_id]" class="form-control row-product">
                      <option value="">- Pilih -</option>
                      @foreach ($products as $prod_item)
                          <option data-price="{{$prod_item->harga}}" {{$item->product_id == $prod_item->id ? 'selected':''}} value="{{$prod_item->id}}">{{$prod_item->name}}</option>
                      @endforeach
                    </select>
                  </td>
                  <td>
                    <input data-currency class="form-control row-price" name="detail[{{$key}}][price]" value="{{$item->price}}" />
                  </td>
                  <td>
                    <input class="form-control row-qty" name="detail[{{$key}}][qty]" value="{{$item->qty}}" />
                  </td>
                  <td>
                    <input readonly data-currency class="form-control row-total" name="detail[{{$key}}][total]"  value="{{$item->total}}"/>
                  </td>
                  <td>
                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
                @endforeach
              @endif
              </tbody>
            </table>
            </div>
            
            <!-- Ttl Price -->
            <div class="form-group col-md-6">
              <label for="ttl_price">Total Price <span class="text-danger">*</span></label>
              <input data-currency autocomplete="off" name="ttl_price" type="text" class="form-control" id="ttl_price" placeholder="" value="{{isset($data) ? $data->ttl_price:''}}">
            </div>
            
            <!-- Ttl Qty -->
            <div class="form-group col-md-6">
              <label for="ttl_qty">Total Qty <span class="text-danger">*</span></label>
              <input autocomplete="off" name="ttl_qty" type="number" class="form-control" id="ttl_qty" placeholder="" value="{{isset($data) ? $data->ttl_qty:''}}">
            </div>
          
          </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <div class="btn-group">
            <a class="btn btn-secondary" href="{{ route($resource.'.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src='{{url('')}}/theme/plugins/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js'></script>
<script src='{{url('')}}/theme/plugins/jquery-ui/jquery-ui.min.js'></script>
<script src="{{url('')}}/theme/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>

<script>
//Datepicker
$('[datepicker]').datepicker({dateFormat: 'yy-mm-dd'});

$('[selectpicker]').selectpicker();

$('[data-currency]').inputmask({
    'alias': 'currency',
    'groupSeparator': '.',
    'digits': 0,
    'digitsOptional': false,
    'prefix': ' Rp. ',
    'placeholder': '0'
  })

  let products = JSON.parse($('#json-product').val());

  $('.add-product').click(function() {
    $('.no-data').hide()
    let length   = $('tbody tr.row-item').length;

    let option = '';

    products.forEach(i => {
      option += `<option value="${i.id}" data-price="${i.harga}">${i.name}</option>`
    })
    let html = `
      <tr class="row-item">
        <td>${length+1}</td>
        <td>
          <select selectpicker data-size=5 data-live-search="true" name="detail[${length}][product_id]" class="form-control row-product">
            <option value="">- Pilih -</option>
            ${option}
          </select>
        </td>
        <td>
          <input required data-currency class="form-control row-price" name="detail[${length}][price]" />
        </td>
        <td>
          <input required class="form-control row-qty" name="detail[${length}][qty]" />
        </td>
        <td>
          <input readonly data-currency class="form-control row-total" name="detail[${length}][total]" />
        </td>
        <td>
          <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
        </td>
      </tr>
    `;

    $('table tbody').append(html)
    $('[selectpicker]').selectpicker();
    $('[data-currency]').inputmask({
      'alias': 'currency',
      'groupSeparator': '.',
      'digits': 0,
      'digitsOptional': false,
      'prefix': ' Rp. ',
      'placeholder': '0'
    })
    $('.row-qty').keyup(function() {
      let tr = $(this).closest('tr');
      let price = tr.find('.row-price').val().replace(/\D/g, '');
      let qty   = $(this).val();
      let total = parseInt(price)*parseInt(qty);
      tr.find('.row-total').val(total);
      calc();
  })
  });

  $(document).on('change', '.row-product', function() {
    let price = $(this).find(':selected').data('price');

    $(this).closest('tr').find('.row-price').val(price)
  })

  function calc() {
    let total_price = 0;
    let total_qty = 0;
    $('tr.row-item').each(function(){
      let row_price = $(this).find('.row-total').val().replace(/\D/g, '')
      let row_qty   = $(this).find('.row-qty').val()
      if(row_price && row_price) {

      total_price += parseInt(row_price);
      total_qty += parseInt(row_qty);

      }
    })

    $('#ttl_price').val(total_price);
    $('#ttl_qty').val(total_qty);

  }

  $('.row-qty').keyup(function() {
      let tr = $(this).closest('tr');
      let price = tr.find('.row-price').val().replace(/\D/g, '');
      let qty   = $(this).val();
      let total = parseInt(price)*parseInt(qty);
      tr.find('.row-total').val(total);
      calc();
  })
</script>
@endpush

@push('styles')
<link rel='stylesheet' href='/theme/plugins/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css' />
<link rel='stylesheet' href='/theme/plugins/jquery-ui/jquery-ui.min.css' />
<link rel='stylesheet' href='/theme/plugins/jquery-ui/jquery-ui.theme.min.css' />

@endpush
