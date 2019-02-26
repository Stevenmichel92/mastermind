<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <script src="main.js"></script>
</head>
<body>

    <div class="container">
        <h1> Mon mastermind</h1>

        <div class="row">
            <div class="col-sm-12 col-md-6">
                <table>
                    <tr>
                        <td id="blue"  onclick="newColor(this.id)"></td> 
                        <td id="red" onclick="newColor(this.id)"></td> 
                        <td id="yellow" onclick="newColor(this.id)"></td> 
                        <td id="orange" onclick="newColor(this.id)"></td> 
                        <td id="green" onclick="newColor(this.id)"></td>
                    </tr>
                </table>
                <br>

                <?php 
                    for($i=1; $i<=10;$i++){  
                    ?>
                    <table style="background-color: rgb(228, 228, 146); border:solid 0.1px">
                        <tr id="ligne_<?=$i?>">
                            <td id="number"><?=$i?></td>
                            <td id="col1_<?=$i?>" onclick="setColor(this, <?=$i?>)"></td>
                            <td id="col2_<?=$i?>" onclick="setColor(this, <?=$i?>)"></td>
                            <td id="col3_<?=$i?>" onclick="setColor(this, <?=$i?>)"></td> 
                            <td id="col4_<?=$i?>" onclick="setColor(this, <?=$i?>)"></td> 

                            <td class="line_result">
                                <div id="black_result1_<?=$i?>"></div>
                                <div id="black_result2_<?=$i?>"></div>
                                <div id="black_result3_<?=$i?>"></div>
                                <div id="black_result4_<?=$i?>"></div>
                
                                <div id="white_result1_<?=$i?>"></div>
                                <div id="white_result2_<?=$i?>"></div>
                                <div id="white_result3_<?=$i?>"></div>
                                <div id="white_result4_<?=$i?>"></div>
                            </td>
                            <td><button id="button_<?=$i?>" type="button" onclick="verif(<?=$i?>)">OK</button></td>
                        </tr>
                    </table>
                    <?php
                    } 
                ?>
            </div>                
            <div class="col-sm-12 col-md-6">
                <h3>Règles du jeu du Master Mind</h3><br>
                <h4>But du jeu</h4>
                <span>Retrouver la combinaison de quatre couleurs.</span><br><br>
                <h4>Déroulement du jeu</h4>
                <span>Quand vous avez rempli une ligne, vous pouvez tester votre combinaison. L'ordinateur affiche alors des points noirs et blancs<span><br><br>
                    <div style="background-color:lightblue">
                        <div id="black_result1_1" style="display:block"> </div> Un point noir correspond à une bille bien placée (bonne couleur, bon emplacement) <br>
                        <div id="white_result1_1" style="display:block"> </div> Un point blanc correspond à une bille de la bonne couleur mais pas au bon emplacement
                    </div><br>
                <span>A l'aide de ces indices, vous pouvez alors commencer une nouvelle ligne. Au bout de 10 lignes échouées, vous avez perdu et la solution s'affiche.</span>    
            </div>
        </div>
    <script>

        function verif(ligne){
            let color1 = document.getElementById('col1_' + ligne).style.backgroundColor; 
            let color2 = document.getElementById('col2_' + ligne).style.backgroundColor; 
            let color3 = document.getElementById('col3_' + ligne).style.backgroundColor; 
            let color4 = document.getElementById('col4_' + ligne).style.backgroundColor; 

            //Bonne couleur et bonne position
            if(color1 == secretColors[0])
                document.getElementById("black_result1_" + ligne).setAttribute("style","display:block");

            if(color2 == secretColors[1])
                document.getElementById("black_result2_" + ligne).setAttribute("style","display:block");

            if(color3 == secretColors[2])
                document.getElementById("black_result3_" + ligne).setAttribute("style","display:block"); 

            if(color4 == secretColors[3])
                document.getElementById("black_result4_" + ligne).setAttribute("style","display:block");  
            
            //Bonne couleur et mauvaise position
                if(color1 != secretColors[0])
                    if(color1 == secretColors[1] || color1 == secretColors[2] || color1 == secretColors[3])
                        if(color1 != color2 || color1 != color3 || color1 != color4)
                            document.getElementById("white_result1_" + ligne).setAttribute("style","display:block");
                    

                if(color2 != secretColors[1])
                    if(color2 == secretColors[0] || color2 == secretColors[2] || color2 == secretColors[3])
                        if (color2 != color1 && color2 != color3)
                            if(color2 != color4)
                            document.getElementById("white_result2_" + ligne).setAttribute("style","display:block");
                               
                if(color3 != secretColors[2])
                    if(color3 == secretColors[1] || color3 == secretColors[3] || color3 == secretColors[0])
                        if(color3 != color2 && color3 != color1)
                            document.getElementById("white_result3_" + ligne).setAttribute("style","display:block");

                if(color4 != secretColors[3])
                    if(color4 == secretColors[0] || color4 == secretColors[2] || color4 == secretColors[1])
                        if(color4 != color1 && color4 != color2)
                            if(color4 != color3)
                                document.getElementById("white_result4_" + ligne).setAttribute("style","display:block");
            
            //Message réussite
            if(color1 == secretColors[0] && color2 == secretColors[1] && color3 == secretColors[2] && color4 == secretColors[3]){
                alert('Vous avez gagné!');
                window.location.reload();
            }
            document.getElementById("button_" + currentLine).setAttribute("style","display:none"); 
            document.getElementById("ligne_" + currentLine).setAttribute("style","background-color: unset"); 
            currentLine++ ; 
            document.getElementById("ligne_" + currentLine).setAttribute("style","background-color: rgb(166, 168, 14)");  
            
        }

        let selectColor = "red";
        let currentLine = 1;

        function newColor(idColor) {
            selectColor = idColor;
        }
        
        function setColor(e, line) {
            if (line == currentLine) {
                e.style.backgroundColor = selectColor;
            }
        }

        let secretColors=["blue","red","yellow","orange","green"];
            for(let position = secretColors.length-1; position>=1; position--){
                
                let hasard = Math.floor(Math.random()*(position+1));
                
                let sauve = secretColors[position];
                secretColors[position] = secretColors[hasard];
                secretColors[hasard] = sauve;
            }
        secretColors.pop();
        console.log(secretColors);
    </script>    
</div>

</body>
</html>