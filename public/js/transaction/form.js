var dataServices    = [];
let dataCustomers   = [];
var option          = '';


axios.get(`${BASE}/service/json`).then(res =>{
    dataServices = res.data.services
    option       = '<option value="">- Pilih -</option>';
    
    dataServices.forEach(item => {
        option += `<option value="${item.id}">${item.name}</option>`
    });
});

axios.get(`${BASE}/client/json`).then(res => {
    dataCustomers      = res.data.clients
    let custOpt        = '<option value="">- Pilih -</option>';

    dataCustomers.forEach(item => {
        custOpt += `<option value="${item.id}">${item.code} | ${item.name_company}</option>`
    })
    $('#clients_id').html(custOpt);
    $('#clients_id').selectpicker();
})

function getItem(EL) {
    EL.change(function() {
        console.log(this)
    });
}

function calculateSummary() {
    let amount = 0;
    let disc   = 0;
    let total  = 0;
    $('.amount').each(function() {
        let val = $(this).val().replace(/\D/g, '');
        amount += val == '' ? 0 : parseInt(val);
    })

    disc  = $('.disc').val() == '' ? 0:$('.disc').val();
    disc  = ((parseInt(disc)/100)*amount);
    total = amount - disc;

    $('#text_sub_total').text(amount.toLocaleString())
    $('#sub_total').val(amount)
    
    $('#text_disc').text(disc.toLocaleString())
    
    $('#text_total').text(total.toLocaleString())
    $('#total').val(total)
}

function addRow() {
    $(".no-data").hide();
    let items  = $(".row-item").toArray();
    let html = `<tr class="row-item">
                    <td>${items.length+1}.</td>
                    <td><select name="detail[${items.length}][services_id]" class="form-control select_${items.length+1}" placeholder="Choose Item">${option}</select></td>
                    <td><input autocomplete="off" name="detail[${items.length}][description]" class="form-control" /></td>
                    <td><input autocomplete="off" name="detail[${items.length}][qty]"         class="form-control qty" style="width: 50px" data-number/></td>
                    <td><input autocomplete="off" name="detail[${items.length}][rate]"        class="form-control rate" style="width: 150px" data-currency /></td>
                    <td><input autocomplete="off" name="detail[${items.length}][amount]"      class="form-control amount" style="width: 150px" data-currency /></td>
                    <td>
                    <button class="btn btn-danger btn-sm row-delete"><i class="fa fa-times"></i>
                    </td>
                </tr>`;
    $('#items-table>tbody').append(html);
    let EL = $(`.row-item>td>select.select_${items.length+1}`);
    EL.selectpicker();
    getItem(EL)

    $(".rate").on('keyup', function() {
        let qty     = $(this).closest('tr').find('.qty').val();
            qty     = isNaN(qty) ? 0:parseInt(qty);
        let rate    = $(this).val().replace(/\D/g, '');
            rate    = isNaN(rate) ? 0:parseInt(rate);
        let amount  = rate*qty
            amount  = isNaN(amount) ? 0 : amount;
        $(this).closest('tr').find('.amount').val(amount);
      
        calculateSummary()
    })
    $('.row-delete').click(function() {
        $(this).closest('tr').remove();
        if(items.length == 0) {
            $(".no-data").show();
        }
        return false;
    })

    $(function () {
        $('[data-currency]').inputmask({
            'alias': 'currency',
            'groupSeparator': '.',
            'digits': 0,
            'digitsOptional': false,
            'prefix': ' Rp. ',
            'placeholder': '0'
        })
        $('[data-number]').inputmask('decimal')
    })
}

$('#date').datepicker({
    autoclose: true,
    language: LANG
})



$("#_add_row").click(function() {
    addRow()
    return false;
})
$("#disc").keyup(function() {
    calculateSummary()
});