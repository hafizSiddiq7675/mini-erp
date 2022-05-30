<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <title>
            Home
        </title>
        <style>
            a:hover {
                color: rgb(242, 227, 234);
              }
            .grid-container{
                padding-top:200px;
                display: grid;

                grid-template-columns: auto auto auto;
                gap: 30px;
                background-color:rgb(59, 163, 59)
                padding: 10px;
                width: 800px;
                padding-left:400px;
                align: center;
                padding-right:0px;

              }

              .grid-container > div{
                background-color: rgba(172, 158, 158, 0.192);
                text-align: center;
                padding: 20px 0;
                font-size: 10px;
                border: 2px solid grey;
                grid-shape:rectangle;
              }

              .item1 { grid-area: 1 / 3 / 2 / 4; }
              .item2 { grid-area: 2 / 3 / 3 / 4; }
              .item3 { grid-area: 1 / 1 / 2 / 2; }
              .item4 { grid-area: 1 / 2 / 2 / 3; }
              .item5 { grid-area: 2 / 1 / 3 / 2; }
              .item6 { grid-area: 2 / 2 / 3 / 3; }

              .grid-container>.item1:hover{
                  background-color:rgb(245, 149, 149);
                  postition:fixed;
                  font-family:sans-serif;
                  color:aliceblue;
                  font-size:15px;


              }
              .grid-container>.item2:hover{
                background-color:rgb(204, 220, 87);
                postition:fixed;
                font-family:sans-serif;
                color:aliceblue;
                font-size:15px;
            }

            .grid-container>.item3:hover{
                background-color:rgb(130, 219, 145);
                postition:fixed;
                font-family:sans-serif;
                color:aliceblue;
                font-size: 15px;

            }

            .grid-container>.item4:hover{
                background-color:rgb(83, 85, 197);
                font-family:sans-serif;
                color:aliceblue;
                font-size: 15px;

            }
            .grid-container>.item5:hover{
                background-color:rgb(255, 106, 210);
                font-family:sans-serif;
                color:aliceblue;
                font-size: 15px;

            }
            .grid-container>.item6:hover{
                background-color:rgb(221, 178, 122);
                font-family:sans-serif;
                color:aliceblue;
                font-size: 15px;

            }





        </style>




    </head>
    <body>
        <div>
            <div class="grid-container ">
                <div class="item1"><a href="/cards">Cards</a></div>
                <div class="item2"><a href="/blurryloading">BlurryLoading</a></div>
                <div class="item3"><a href="/progress-steps">Progress Steps</a></div>
                <div class="item4"><a href="/scrollanimation">Scroll Animation</a></div>
                <div class="item5"><a href="search-wizard">Search Wizard</a></div>
                <div class="item6"><a href="splitpage">Split Pages</a></div>
              </div>
    </body>
</html>
