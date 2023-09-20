$('#full_url').click(async function () {
    const fromClipboard = await navigator.clipboard.readText();
    $('#full_url').val(fromClipboard);
});


// $('#shorten').submit(function () {

//     var data = {
//         'full_url': $('#full_url').val()
//     }

//     $.ajax({
//         url: './shorten.php',
//         method: 'POST',
//         data: data,
//         success: function (result) {
//             console.log(result);
//             var response = JSON.parse(result);
//             if (response.status == 1) {

//                 // console.log(response.short_code);

//                 // push it to localstorage
//                 var lsdata = localStorage.getItem('shortened_urls');

//                 var stringifiedLsdata;

//                 if (lsdata) {
//                     var parsedLsdata = JSON.parse(lsdata);
//                     parsedLsdata[response.short_code] = $('#full_url').val();
//                     stringifiedLsdata = JSON.stringify(parsedLsdata);
//                     console.log(stringifiedLsdata);
//                 } else {
//                     var data = {};
//                     data[response.short_code] = $('#full_url').val();
//                     // console.log(data);
//                     stringifiedLsdata = JSON.stringify(data);

//                 }

//                 var olds = $('#shortened_url_lists').html();
//                 var frontend_lis = "<li>";
//                 frontend_lis += '<a target="_blank" href="' + $('#full_url').val() +'">' + $('#full_url').val()+ '</a>';
//                 frontend_lis += '<div class="arrow">&rarr;</div>';
//                 frontend_lis += '<a target="_blank" href="' + window.location.href  + response.short_code + '">' + window.location.href + response.short_code + '</a>';
//                 frontend_lis += '</li>';
//                 olds = frontend_lis + olds;
//                 $('#shortened_url_lists').html(frontend_lis);

//                 localStorage.setItem('shortened_urls', stringifiedLsdata);

//                 $('#full_url').val('');

//             } else {
//                 alert(response.message);
//             }
//         }
//     });

//     return false;
// });


// $(document).ready(function () {
//     var lsdata = localStorage.getItem('shortened_urls');
//     if (lsdata) {
//         var parsedLsdata = JSON.parse(lsdata);

//         var frontend_lis = '';

//         for (key in parsedLsdata) {
//             frontend_lis += "<li>";
//             frontend_lis += '<a target="_blank" href="' + parsedLsdata[key] + '">' + parsedLsdata[key] + '</a>';
//             frontend_lis += '<div class="arrow">&rarr;</div>';
//             frontend_lis += '<a target="_blank" href="'+ window.location.href + key + '">' + window.location.href + key + '</a>';
//             frontend_lis += '</li>';
//         }

//         // alert(frontend_lis);
//         $('#shortened_url_lists').html(frontend_lis);
//     }
// });

$('#shorten').submit(function () {
    var full_url = $('#full_url').val();
    localStorage.setItem('new_url', full_url);
});




// var num = 5;
// var fact = 1;
// while (num != 0) {
//     fact = fact * num--;
// }

// console.log(fact);

// function facto(num){
//     if(num==0)
//         return 1;
//     return num*facto(--num);
// }

// console.log(facto(5));