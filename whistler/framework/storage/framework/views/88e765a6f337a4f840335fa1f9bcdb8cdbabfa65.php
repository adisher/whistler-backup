<?php
    $dk = array_keys($dates);
?>
<?php $__env->startSection('extra_css'); ?>
    <style type="text/css">
        .info-box-4 .icon {
            position: absolute;
            right: 10px;
            bottom: 2px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .info-box-4 .icon.zoom-effect:hover {
            transform: scale(1.15);
            transition: transform 0.3s ease;
        }

        .fa-truck.active {
            animation: moveBackAndForth 2s infinite;
        }

        @keyframes moveBackAndForth {
            0% {
                transform: translateX(0);
            }

            50% {
                transform: translateX(-10px);
            }

            100% {
                transform: translateX(0);
            }
        }

        .info-box-4 {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            height: 80px;
            display: flex;
            cursor: default;
            background-color: #fff;
            position: relative;
            overflow: hidden;
            margin-bottom: 30px;
        }

        .info-box-4.hover-zoom-effect .icon i {
            -moz-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            -webkit-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }

        .info-box-4 .icon i {
            color: rgba(3, 66, 255, 0.5);
            font-size: 60px;
        }

        .info-box-4 .content {
            display: inline-block;
            padding: 7px 16px;
        }

        .info-box-4 .content .text {
            font-size: 18px;
            margin-top: 11px;
            color: #555;
        }

        .info-box-4 .content .number {
            font-weight: normal;
            font-size: 26px;
            margin-top: -4px;
            color: #555;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                  <i class="fas fa-chevron-down mr-2" data-toggle="collapse" data-target="#yield"></i>
                  <h5 class="card-title mb-0">Yield Status</h5>
                </div>

                <div class="card-body collapse show" id="yield">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="chart">
                                <?php ($useragent = $_SERVER['HTTP_USER_AGENT']); ?>
                                <?php if(preg_match(
                                        '/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge
                                              |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm(os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows
                                              ce|xda|xiino/i',
                                        $useragent) ||
                                        preg_match(
                                            '/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a
                                              wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r
                                              |s
                                              )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1
                                              u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp(i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac(
                                              |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt
                                              |kwc\-|kyo(c|k)|le(no|xi)|lg(g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-|
                                              |o|v)|zz)|mt(50|p1|v
                                              )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v
                                              )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-|
                                              )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',
                                            substr($useragent, 0, 4))): ?>
                                    <?php ($height = '600'); ?>
                                <?php else: ?>
                                    <?php ($height = '250'); ?>
                                <?php endif; ?>
                                <canvas id="datewise" width="800" height="<?php echo e($height); ?>"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <i class="fas fa-chevron-down mr-2" data-toggle="collapse" data-target="#fuel"></i>
                    <h5 class="card-title mb-0">Fuel Level</h5>
                </div>
        
                <div class="card-body collapse show" id="fuel">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="chart">
                                <?php ($useragent = $_SERVER['HTTP_USER_AGENT']); ?>
                                <?php if(preg_match(
                                '/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge
                                |maemo|midp|mmp|mobile.+firefox|netfront|opera
                                m(ob|in)i|palm(os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows
                                ce|xda|xiino/i',
                                $useragent) ||
                                preg_match(
                                '/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a
                                wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r
                                |s
                                )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1
                                u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp(i|ip)|hs\-c|ht(c(\-|
                                |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac(
                                |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt(
                                |\/)|klon|kpt
                                |kwc\-|kyo(c|k)|le(no|xi)|lg(g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-|
                                |o|v)|zz)|mt(50|p1|v
                                )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v
                                )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-|
                                )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',
                                substr($useragent, 0, 4))): ?>
                                <?php ($height = '600'); ?>
                                <?php else: ?>
                                <?php ($height = '250'); ?>
                                <?php endif; ?>
                                <canvas id="datewise2" width="800" height="<?php echo e($height); ?>"></canvas>
        
                            </div>
                        </div>
        
                    </div>
        
                </div>
            </div>
        </div>
    </div>
    
    <div class="row" id="myDiv">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"><?php echo app('translator')->get('fleet.monthly_chart'); ?> <?php echo e(date('F')); ?></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h5> <?php echo app('translator')->get('fleet.income'); ?> - <?php echo app('translator')->get('fleet.expense'); ?> </h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="canvas" width="400" height="400"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h5> <?php echo app('translator')->get('fleet.vehicle'); ?> <?php echo app('translator')->get('fleet.expenses'); ?> </h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="canvas2" width="400" height="400"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-header d-flex align-items-center">
                  <i class="fas fa-chevron-down mr-2" data-toggle="collapse" data-target="#finance"></i>
                  <h5 class="card-title mb-0">Income | Expense Chart</h5>
                </div>
                <div class="card-body collapse show" id="finance">
                    <?php ($useragent = $_SERVER['HTTP_USER_AGENT']); ?>
                    <?php if(preg_match(
                            '/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge
                            |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm(os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows
                            ce|xda|xiino/i',
                            $useragent) ||
                            preg_match(
                                '/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a
                            wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s
                            )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1
                            u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp(i|ip)|hs\-c|ht(c(\-|
                            |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac(
                            |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt
                            |kwc\-|kyo(c|k)|le(no|xi)|lg(g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-|
                            |o|v)|zz)|mt(50|p1|v
                            )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v
                            )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-|
                            )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',
                                substr($useragent, 0, 4))): ?>
                        <?php ($height = '600'); ?>
                    <?php else: ?>
                        <?php ($height = '300'); ?>
                    <?php endif; ?>
                    <div class="chart"><canvas id="yearly" width="800" height="<?php echo e($height); ?>"></canvas> </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-header d-flex align-items-center">
                    <i class="fas fa-chevron-down mr-2" data-toggle="collapse" data-target="#purchase"></i>
                    <h5 class="card-title mb-0">Fleet Rental</h5>
                </div>
                <div class="card-body collapse show" id="purchase">
                    <?php ($useragent = $_SERVER['HTTP_USER_AGENT']); ?>
                    <?php if(preg_match(
                    '/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge
                    |maemo|midp|mmp|mobile.+firefox|netfront|opera
                    m(ob|in)i|palm(os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows
                    ce|xda|xiino/i',
                    $useragent) ||
                    preg_match(
                    '/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a
                    wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s
                    )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1
                    u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp(i|ip)|hs\-c|ht(c(\-|
                    |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac(
                    |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt
                    |kwc\-|kyo(c|k)|le(no|xi)|lg(g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-|
                    |o|v)|zz)|mt(50|p1|v
                    )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v
                    )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-|
                    )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',
                    substr($useragent, 0, 4))): ?>
                    <?php ($height = '600'); ?>
                    <?php else: ?>
                    <?php ($height = '300'); ?>
                    <?php endif; ?>
                    <div class="chart"><canvas id="purchases" width="800" height="<?php echo e($height); ?>"></canvas> </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script2'); ?>
    <script src="<?php echo e(asset('assets/js/cdn/Chart.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/cdn/canvasjs.min.js')); ?>"></script>
    <script>
        window.chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(201, 203, 207)',
            black: 'rgb(0,0,0)'
        };



        function random_color(i) {
            var color1, color2, color3;
            var col_arr = [];
            for (x = 0; x <= i; x++) {

                var c1 = [176, 255, 84, 220, 134, 66, 238];
                var c2 = [254, 61, 147, 114, 51, 26, 137];
                var c3 = [27, 111, 153, 93, 157, 216, 187, 44, 243];
                color1 = c1[Math.floor(Math.random() * c1.length)];
                color2 = c2[Math.floor(Math.random() * c2.length)];
                color3 = c3[Math.floor(Math.random() * c3.length)];

                col_arr.push("rgba(" + color1 + "," + color2 + "," + color3 + ",0.5)");
            }
            return col_arr;
        }

        var chartData = {
            labels: ["<?php echo app('translator')->get('fleet.income'); ?>", "<?php echo app('translator')->get('fleet.expense'); ?>"],

            datasets: [{
                type: 'pie',
                label: '',
                backgroundColor: ['#21bc6c', '#ff5462'],
                borderColor: window.chartColors.red,
                borderWidth: 1,
                data: [<?php echo e($income); ?>, <?php echo e($expense); ?>]
            }]
        };

        var config = {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                    'October', 'November', 'December'
                ],
                datasets: [{
                        label: 'Income',
                        data: [1000, 1200, 800, 1500, 2000, 1800, 1600, 1900, 2200, 2500, 2300, 2800],
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Expense',
                        data: [800, 900, 1000, 1200, 1500, 1300, 1400, 1700, 1800, 2000, 1900, 2100],
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true
            }
        };
        var yieldData = [350, 250, 300];
        var datewise_config = {
            type: 'bar',
            data: {
                labels: [
                    <?php $__currentLoopData = $dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        CanvasJS.formatDate(new Date("<?php echo e(date('Y-m-d H:i:s', strtotime($k))); ?>"), "DD/MM/YY"),
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ],
                datasets: [{
                    label: 'Product Yield Quantity (gms)',
                    data: yieldData,
                    backgroundColor: '#ff5462',
                    borderColor: '#ff5462',
                    // data: [<?php echo e($expenses1); ?>],
                    fill: false,

                    //{
                    //     label: "<?php echo app('translator')->get('fleet.income'); ?>",
                    //     fill: false,
                    //     backgroundColor: '#21bc6c',
                    //     borderColor: '#21bc6c',
                    //     data: [<?php echo e($incomes); ?>],
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: false,
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: "<?php echo app('translator')->get('fleet.date'); ?>"
                        }
                    }],
                    yAxes: [{
                    display: true,
                    ticks: {
                    beginAtZero: true, // start at zero
                    stepSize: 100, // increment by 50
                    },
                    scaleLabel: {
                    display: true,
                    labelString: "Quantity"
                    }
                    }]
                }
            }
        };
        var fuelData = [30, 25, 40, 35, 50];
        var fuelData2 = [20, 15, 30, 25, 40];
        var datewise_config2 = {
            type: 'bar',
            data: {
                labels: [
                    <?php $__currentLoopData = $dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        CanvasJS.formatDate(new Date("<?php echo e(date('Y-m-d H:i:s', strtotime($k))); ?>"), "DD/MM/YY"),
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ],
                datasets: [{
                        label: 'Fuel Purchase (liters)',
                        data: fuelData,
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                    },
                    {
                        label: 'Fuel Consumption (liters)',
                        data: fuelData2,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                    },
                ]
            },
            options: {
                responsive: true,
                title: {
                    display: false,
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: "<?php echo app('translator')->get('fleet.date'); ?>"
                        }
                    }],
                    yAxes: [{
                        display: true,
                        beginAtZero: true,
                        scaleLabel: {
                            display: true,
                            labelString: "Quantity (litres)"
                        }
                    }]
                },
            },
            // options: {
            //     responsive: true,

            //     scales: {
            //         xAxes: [{
            //             display: true,
            //             scaleLabel: {
            //                 display: true,
            //                 labelString: "<?php echo app('translator')->get('fleet.date'); ?>"
            //             }
            //         }],
            //         yAxes: [{
            //             display: true,
            //             scaleLabel: {
            //                 display: true,
            //                 labelString: "<?php echo app('translator')->get('fleet.amount'); ?>"
            //             }
            //         }]
            //     }
            // }
        };
        // fleet purchase chart
        var purchasesArray = [
        { month: 'January', purchase: 200000 },
        { month: 'March', purchase: 400000 },
        { month: 'April', purchase: 250000 },
        { month: 'December', purchase: 600000 },
        ];
        
        var purchaseLabels = purchasesArray.map(function(purchase) {
        return purchase.month;
        });
        
        var purchaseData = purchasesArray.map(function(purchase) {
        return purchase.purchase;
        });

        window.onload = function() {
            $('.count-to').countTo();
            // const iconElement = document.querySelector('.info-box-4 .icon');
            // if (!iconElement.classList.contains('active')) {
            //   iconElement.classList.add('zoom-effect');
            // } else {
            //   iconElement.classList.remove('zoom-effect');
            // }
            var ctxPurchase = document.getElementById("purchases").getContext("2d");
            var configPurchase = {
            type: 'line',
            data: {
            labels: purchaseLabels, // This would be the labels array from earlier
            datasets: [{
            label: 'Fleet Rental',
            data: purchaseData, // This would be the data array from earlier
            backgroundColor: 'rgba(75, 192, 192, 0.6)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
            }]
            },
            options: {
            responsive: true
            }
            };
            window.myLine = new Chart(ctxPurchase, configPurchase);
            var divElement = document.getElementById("myDiv");
            divElement.style.display = "none";
            var ctx = document.getElementById("yearly").getContext("2d");
            window.myLine = new Chart(ctx, config);
            var ctx = document.getElementById("canvas").getContext("2d");
            var datewise = document.getElementById("datewise").getContext("2d");
            window.myLine = new Chart(datewise, datewise_config);
            window.myMixedChart = new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: {
                    legend: {
                        display: false
                    },
                    responsive: true,

                    tooltips: {
                        mode: 'index',
                        intersect: false
                    }
                }
            });

            var datewise2 = document.getElementById("datewise2").getContext("2d");
            window.myLine = new Chart(datewise2, datewise_config2);
            window.myMixedChart = new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: {
                    legend: {
                        display: false
                    },
                    responsive: true,

                    tooltips: {
                        mode: 'index',
                        intersect: false
                    }
                }
            });

            var ctx = document.getElementById("canvas2").getContext("2d");
            window.myMixedChart = new Chart(ctx, {
                type: 'bar',
                data: chartData3,
                options: {

                    responsive: true,
                    title: {
                        display: false,
                        text: "<?php echo app('translator')->get('fleet.chart'); ?>"
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: true
                    }
                }
            });
        };



        var chartData3 = {
            labels: [
                <?php $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    "<?php echo e($vehicle_name[$exp->vehicle_id]); ?>",
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            ],
            datasets: [{
                type: 'bar',
                label: '',
                backgroundColor: random_color(<?php echo e(count($expenses)); ?>),
                borderColor: window.chartColors.black,
                borderWidth: 1,
                data: [
                    <?php $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($exp->expense); ?>,
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ]
            }]
        };
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        $('[data-toggle="collapse"]').on('click', function() {
            var icon = $(this);
            icon.toggleClass('fa-chevron-down fa-chevron-up');
        });
        $("#year").on("change", function() {
            var year = this.value;
            // alert(status);
            window.location = "<?php echo e(url('admin/')); ?>" + "?year=" + year; // redirect
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        var data = [{
                    y: '2014',
                    a: 50,
                    b: 90
                },
                {
                    y: '2015',
                    a: 65,
                    b: 75
                },
                {
                    y: '2016',
                    a: 50,
                    b: 50
                },
                {
                    y: '2017',
                    a: 75,
                    b: 60
                },
                {
                    y: '2018',
                    a: 80,
                    b: 65
                },
                {
                    y: '2019',
                    a: 90,
                    b: 70
                },
                {
                    y: '2020',
                    a: 100,
                    b: 75
                },
                {
                    y: '2021',
                    a: 115,
                    b: 75
                },
                {
                    y: '2022',
                    a: 120,
                    b: 85
                },
                {
                    y: '2023',
                    a: 145,
                    b: 85
                },
                {
                    y: '2024',
                    a: 160,
                    b: 95
                }
            ],
            config = {
                data: data,
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['Total Income', 'Total Outcome'],
                fillOpacity: 0.6,
                hideHover: 'auto',
                behaveLikeLine: true,
                resize: true,
                pointFillColors: ['#ffffff'],
                pointStrokeColors: ['black'],
                lineColors: ['gray', 'red']
            };
        config.element = 'area-chart';
        Morris.Area(config);
        config.element = 'line-chart';
        Morris.Line(config);
        config.element = 'bar-chart';
        Morris.Bar(config);
        config.element = 'stacked';
        config.stacked = true;
        Morris.Bar(config);
        Morris.Donut({
            element: 'pie-chart',
            data: [{
                    label: "Friends",
                    value: 30
                },
                {
                    label: "Allies",
                    value: 15
                },
                {
                    label: "Enemies",
                    value: 45
                },
                {
                    label: "Neutral",
                    value: 10
                }
            ]
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/whistler/framework/resources/views/home.blade.php ENDPATH**/ ?>