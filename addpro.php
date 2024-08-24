<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <link rel="stylesheet" href="css/navbarstyle.css">
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>
<div>
    <?php include 'navbar/adminnav.php'; ?>
</div>
<form id="databook" name="databook">
        <div class="Container-Fluid" style="justify-content: center;">
            <div class="Row" style="display:flex; justify-content:center; align-items:center; min-height:80vh;">
                <div class="frame">
                    <h1>ขาย</h1>
                    <!-- กรอกชื่อหนังสือ -->
                    <label>ชื่อดนตรี</label><br>
                    <div class="input-box">
                        <input type="text" id="musicname" name="musicname">
                    </div>
                    <!-- กรอกปีหนังสือ -->
                    <!-- กรอกประเภทหนังสือ -->
                    <label>ประเภทหนังสือ</label>
                    <div class="input-box">
                        <input type="text" id="music_type" name="music_type">
                    </div>
                    <label>กรอกราคา</label>
                    <div>
                        <input type="number" style="width: 300px;" id="music_price" name="music_price" placeholder="ตัวเลข">
                    </div>
                    <br>
                    <button type="submit" id="button-submit" class="buttonsubmit">วางขาย</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>