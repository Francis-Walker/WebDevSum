<?php?>

<script
    src="https://code.jquery.com/jquery-3.4.1.js"
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>

<html>
<head>

</head>
<body>
<button  id="buttonTest">
    test
</button>

<!--<input type="button" value="test" onclick="">-->

</body>
</html>

<script>



    function insertTest(){
        alert("2");

        $.ajax({
            url:'includes/dbFunctions.php',
            type:"post",
            data: {
                fun: 'submitTicket',
                type: 'testy1',
                iso: '420',
                com: "hello",
                chg: "2"
            },
            success: function(){alert("worked");}
        })


    }
    document.getElementById("buttonTest").addEventListener("click", insertTest);
</script>
<!--//             function(){-->
<!--//                 $("#test").load("dbFunctions.php",{-->
<!--//                     fun: submitTicket,-->
<!--//                     type: 'testy1',-->
<!--//                     iso: '420',-->
<!--//                     com: "hello",-->
<!--//                     chg: "2"-->
<!--//-->
<!--//-->
<!--//                 });-->
<!--//             }-->
<!--//         );-->
<!--//     }-->
<!--//-->
<!--// );-->
<!--//         $("button").click(-->


