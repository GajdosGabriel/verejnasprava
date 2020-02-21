@extends('layouts.app')

@section('content')

        <h2>Upraviť objednávku</h2>

    {!! Form::model($order, ['route' => ['updateorder', $order->id ], 'method' => 'put', 'files'=> 'true', 'class' => 'post', 'id' => 'add-form' , 'enctype' => 'multipart/form-data'])  !!}
        <div class="col-md-12">
        @include('order.header')
        @include('order.form')
            </div>

@endsection



@section('script')
    <script type="text/javascript">
        jQuery(function(){
            var counter = 1;
            jQuery('#add').click(function(event){
                event.preventDefault();
                var newRow = jQuery('<tr class="my_row"><td><textarea id="name" name="itemName[]" rows="1" cols="50" class="input">Objednávame </textarea></td> <td><input type="text" id="item" name="quantity[]" class="item input"></td><td><input type="text" id="price" name="price[]" class="price input"></td><td><input type="text" id="total" name="total[]" class="total input" readonly="true"></td><td><input type="button" name="delete" class="input" value="Zmazať" onclick="deleteRow(this)"></td></tr>');
                counter++;
                jQuery('.my_table').append(newRow);
            });
        });

        function deleteRow(btn) {
            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
            subTotal();
        }

        function subTotal(){
            var sub_t = 0;
            $(".total").each(function(k, v){
                var subt= +$(this).val()-0;
                sub_t+=subt;
            });
            $(".sub_total").val(sub_t);
        }

        function tax(){
            $(document).ready(function(){
                $(".tax").on("change",function(){
                    var a =parseInt($("#tax").val());
                    var b =parseInt($("#sub_total").val());
                    var sum = ((b/100)*a)+b;
                    $(".tax_total").val(sum);
                });
            });
        }

        $('body').delegate('#item,#price,#total','keyup',function(){

            var tr=$(this).parent().parent();
            var num=tr.find('#item').val();
            var price=tr.find('#price').val();
            amount=num*price;
            tr.find('#total').val(amount);
            subTotal();
        });
        $('body').delegate('#tax','keyup',function(){
            tax();
        });
    </script>
@endsection