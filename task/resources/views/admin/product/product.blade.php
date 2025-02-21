@extends('admin.layout.master')

@section('title', 'Pradyum Task')

@section('layoutContent')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="mb-2 row">
            <div class="col-sm-6">
                <h1>Create Product Stock Form</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <!-- Success Message -->

            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create Product Stock</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('product.store') }}" method="post">
                        @csrf



                        <div class="card-body">
                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input type="text" name="product_name"
                                    class="form-control @error('product_name') is-invalid @enderror" id="product_name"
                                    value="{{ old('product_name') }}" placeholder="Product Name">
                                @error('product_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="quantity_in_stock">Quantity In Stock</label>
                                <input type="number" name="quantity_stock"
                                    class="form-control @error('quantity_stock') is-invalid @enderror"
                                    id="quantity_in_stock" value="{{ old('quantity_stock') }}" placeholder="Quantity">
                                @error('quantity_stock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="price">Price Per Item</label>
                                <input type="number" step="0.01" name="price"
                                    class="form-control @error('price') is-invalid @enderror" id="price"
                                    value="{{ old('price') }}" placeholder="Price Per Item">
                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<section class="content-header">
    <div class="container-fluid">
        <div class="mb-2 row">
            <div class="col-sm-6">
                <h1>Product StockDetails</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total Price</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Edit/Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $totalSum = 0; @endphp
                                    <!-- Initialize total sum -->
                                    @foreach ($products as $product)
                                    @php
                                    $totalPrice = $product->quantity_stock * $product->price;
                                    $totalSum += $totalPrice;
                                    @endphp
                                    <tr>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->quantity_stock }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ number_format($totalPrice, 2) }}</td>
                                        <td>{{ $product->created_at->format('d M Y h:i A') }}</td>
                                        <td>{{ $product->updated_at->format('d M Y h:i A') }}</td>


                                        <td>
                                            <a href="{{ route('product.edit', $product->id) }}"
                                                class="btn btn-sm btn-warning">Edit</a>

                                            <form action="{{ route('product.destroy', $product->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
                                            </form>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-right">Total Value:</th>
                                        <th>{{ number_format($totalSum, 2) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

<!-- Page specific script -->
<script>
    $(function () {
    $("#jsGrid1").jsGrid({
        height: "100%",
        width: "100%",

        sorting: true,
        paging: true,

        data: db.clients,

        fields: [
            { name: "Name", type: "text", width: 150 },
            { name: "Age", type: "number", width: 50 },
            { name: "Address", type: "text", width: 200 },
            { name: "Country", type: "select", items: db.countries, valueField: "Id", textField: "Name" },
            { name: "Married", type: "checkbox", title: "Is Married" }
        ]
    });
  });
</script>
@endsection