<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/style.css" rel="stylesheet">
        <title>Alkon hinnasto</title>
    </head>
    <body>
        <?php
            require_once "getData.php";
            require_once "createTable.php";
            require_once "getFileDate.php";
            require_once "update.php";
            require_once "createBtn.php";
 
        ?> 

        <header>
            <div class="wrap">
                <h1>Alkon hinnasto <?php echo getFileDate(); ?></h1>
            </div>
        </header>
        
        <div class="filter-box">
            <form method="post"> 
                <div><ul>
                    <li><input type="submit" name="updatebtn" value="Päivitä hinnasto" /> </li>
                    <li><input type="submit" id ="reset" name="reset"  onclick="resetFilters()" value="Reset"></li>
                </ul></div>
                <div><ul>
                    <li><?php createTyyppiOption($tyyppiDataArray); ?></li>
                    <li><?php createValmistusmaaOption($valmistusmaaDataArray); ?></li>
                    <li><?php createPullokokoOption($pullokokoDataArray); ?></li>
                </ul></div>
                <div><ul>
                    <li><?php createHintaMINOption($HintaMINDataArray); ?></li>
                    <li><?php createHintaMAXOption($HintaMAXDataArray); ?></li>
                    <li>Järjestä: 
                        <select name="formSort" id='sort' onchange='submit()'>
                            <option <?php if ($varSort == '') { ?>selected="true" <?php }; ?>value="">--</option>
                            <option <?php if ($varSort == 'nimi') { ?>selected="true" <?php }; ?>value="nimi">Nimi</option>
                            <option <?php if ($varSort == 'hintaMinMax') { ?>selected="true" <?php }; ?>value="hintaMinMax">Halvimmat ensin</option>
                            <option <?php if ($varSort == 'hintaMaxMin') { ?>selected="true" <?php }; ?>value="hintaMaxMin">Kalleimmat ensin</option>
                        </select>
                    </li>
                </ul></div>
                <div><ul>
                    <li>Tuotteita: <?php echo number_format($filteredRowCount , 0, '.', ' ') . ' / ' . number_format($rowCount , 0, '.', ' ') ?></li> 
                    <li><?php createPagesOption($pageCount); ?></li>
                    <li>Näytä: 
                        <select name="formLimit" id='limit' onchange='submit()'>
                            <option <?php if ($limit == 25) { ?>selected="true" <?php }; ?>value=25>25</option>
                            <option <?php if ($limit == '50') { ?>selected="true" <?php }; ?>value=50>50</option>
                            <option <?php if ($limit == '100') { ?>selected="true" <?php }; ?>value=100>100</option>
                        </select>
                    </li>
                </ul></div>
            </form>
            
        </div>
        
        <div class="wrap">
            <?php
                createTable($talbeDataArray);
            ?>
            <div></div>
        </div>
       
    </body>

    <script>
        function resetFilters() {
            document.getElementById("tyyppi").selectedIndex=0;
            document.getElementById("valmistusmaa").selectedIndex=0;
            document.getElementById("pullokoko").selectedIndex=0;
            document.getElementById("hintaMIN").selectedIndex=0;
            document.getElementById("hintaMAX").selectedIndex=0;
            document.getElementById("sort").selectedIndex=0;
            document.getElementById("page").selectedIndex=0;
            document.getElementById("limit").selectedIndex=0;
        }
    </script>

</html>