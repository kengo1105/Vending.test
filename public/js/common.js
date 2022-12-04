const { eq } = require("lodash");

function checkDelete() {
    if(!window.confirm('本当に削除してよろしいですか？')) {
        return false;
    }
}

//非同期処理
$(function() {
    $('#search_buttom').on('click', function(e) {
        e.preventDefault();
        //リクエストパラメータ
        let input = {
            p_name : $("#product_name").val(),
            c_id : $("#company_id").val()
        };
        let p_val = {
            id : $('.p-list1').text(),
            product_name : $('.p-list2').val(),
            image : $('#gazou').attr('src'),
            price : $('.p-list4').val(),
            stock : $('.p-list5').val(),
            company_name : $('.p-list6').val()
        };
        
        if(!input) {
            return false;
        }
        $.ajax({
            type : 'GET',
            url : '/products',
            data : {
                'input_data' :input,
                'input_val' :p_val
            }
            // dataType : "JSON"
        }).done(function(data) {
            $(".products-list td").empty();
            // console.log(data);
            console.log(p_val);
            let html = "";
            if(input) {
                $.each(data.p_val, function(index, value) {
                    let id = p_val.id;
                    let product_name = p_val.product_name;
                    let img = p_val.image;
                    let price = p_val.price;
                    let stock = p_val.stock;
                    let company_name = p_val.company_name;
                    html = `
                        <td class="p-list1">${id}</td>
                        <td class="p-list2">${product_name}</td>
                        <td class="p-list3"><img class="img" src="${img}"></td>
                        <td class="p-list4">${price}</td>
                        <td class="p-list5">${stock}</td>
                        <td class="p-list6">${company_name}</td>
                        <td class="p-list7"><a class="detbtn" href="/products/${id}">商品詳細</a></td>
                        <td class="p-list8"><a class="delbtn" href="/products/delete/${id}" onclick="return checkDelete();">削除</a></td>
                    `
                $('tbody tr').append(html);
                })
            }
            }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
                alert('error!!!');
                console.log("XMLHttpRequest : " + XMLHttpRequest.status);
                console.log("textStatus     : " + textStatus);
                console.log("errorThrown    : " + errorThrown.message);
        });
    });
});

        // var add_coupon = 
        // '<div class="add_coupon_div"><p class="confirmation_l"><span>'+ret.coupon[0].name+'</span></p>'+'<p class="coupon_cancel">+ キャンセル</p><input type="hidden" value='+ ret.coupon[0].id +'></div>'
        //           $('.coupon_div').append(add_coupon);
        
        // alert(input);
// $('.products-list').empty();
// $('.products-list td').each(function(){
//     let pro_val = $(this).text();
//     if(pro_val.indexOf(input) != -1) {
//         $('.products-list td').show();
//     }else{
//         $(this).hide();
//     }
// })





// $.ajax({
//     method : "GET",
//     // contentType : "application/json",
//     url : "/products",
//     data : {kyeword: product_data},
//     dataType : "JSON",
// }).done(function(data) {
//     $(".products-list").empty(); 
//     $(".products-list").each(function(){
//     if(product_data != ''){
//         $(this).show();
//     }else{
//         $(this).hide();
//     }
//     });
//     if(product_data == ''){
//         return false;
//     }
//     // console.log(data);
// }).fail(function() {
//     alert('error');
// });
