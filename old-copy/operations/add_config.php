<?php
error_reporting(0);
include "../includes/config.php";

if($_POST['sale_per'])
{


$sale_per = $_POST['sale_per'];
$query=mysqli_query($conn, "UPDATE tbl_company set  sale_per=$sale_per");

}
if($_POST['avo_perc'])
{

$avo_perc = $_POST['avo_perc'];
$query=mysqli_query($conn, "UPDATE tbl_company set  avo_perc=$avo_perc");

echo  '
<input type="text" class="knob" value="'.$avo_perc.'" id="avo_perc" data-width="70" data-height="70" data-thickness="0.1"  data-fgColor="#2196f3" onchange="add_avo_perc();">
                                    <h6>AVO Percentage</h6>
                                    <span>AVO percentage for this month</span>
';

}

if($_POST['mo_perc'])
{

$mo_perc = $_POST['mo_perc'];
$query=mysqli_query($conn, "UPDATE tbl_company set  mo_perc=$mo_perc");


}
?>
<script type="text/javascript">
	
$(function () {
    $('.knob').knob({
        draw: function () {
            // "tron" case
            if (this.$.data('skin') == 'tron') {

                var a = this.angle(this.cv)  // Angle
                    , sa = this.startAngle          // Previous start angle
                    , sat = this.startAngle         // Start angle
                    , ea                            // Previous end angle
                    , eat = sat + a                 // End angle
                    , r = true;

                this.g.lineWidth = this.lineWidth;

                this.o.cursor
                    && (sat = eat - 0.3)
                    && (eat = eat + 0.3);

                if (this.o.displayPrevious) {
                    ea = this.startAngle + this.angle(this.value);
                    this.o.cursor
                        && (sa = ea - 0.3)
                        && (ea = ea + 0.3);
                    this.g.beginPath();
                    this.g.strokeStyle = this.previousColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                    this.g.stroke();
                }

                this.g.beginPath();
                this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                this.g.stroke();

                this.g.lineWidth = 2;
                this.g.beginPath();
                this.g.strokeStyle = this.o.fgColor;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                this.g.stroke();

                return false;
            }
        }
    });
});
</script>