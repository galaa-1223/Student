@extends('../student.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Багшийн хичээлийн хуваарь</h2>
    </div>
    <!-- BEGIN: Huvaari bagsh -->
    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">{{ $student->angi }} {{ $student->angi_course }}{{ $student->angi_buleg }} ангийн хичээлийн хуваарь</h2>
            <div class="text-gray-600 text-xs whitespace-nowrap mt-0.5">Ангийн багш: {{ Str::substr($student->bagsh_ovog, 0, 1) }}. {{ $student->bagsh }}</div>
        </div>
        <div class="p-5" id="hoverable-table">
            <div class="preview">
                <div class="overflow-x-auto">
                    <table class="table border-yellow-500 huvaari-table">
                        <thead>
                            <tr>
                                <th class="border border-b-2 bg-theme-1 dark:border-dark-5 whitespace-nowrap text-white text-center w-20">Цаг / Өдөр</th>
                                <th class="border border-b-2 bg-theme-1 dark:border-dark-5 whitespace-nowrap text-white text-center w-1/6">Даваа</th>
                                <th class="border border-b-2 bg-theme-1 dark:border-dark-5 whitespace-nowrap text-white text-center w-1/6">Мягмар</th>
                                <th class="border border-b-2 bg-theme-1 dark:border-dark-5 whitespace-nowrap text-white text-center w-1/6">Лхагва</th>
                                <th class="border border-b-2 bg-theme-1 dark:border-dark-5 whitespace-nowrap text-white text-center w-1/6">Пүрэв</th>
                                <th class="border border-b-2 bg-theme-1 dark:border-dark-5 whitespace-nowrap text-white text-center w-1/6">Баасан</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // dd($huvaariud);
                                $date = explode(":", config('settings.huvaari_ehleh'));

                                $tsag = $date[0];
                                $minu = $date[1];

                                $hicheelleh = config('settings.huvaari_urgeljleh');
                                $zavsar = config('settings.huvaari_zavsarlaga');
                                $ihzasvar = config('settings.huvaari_ih_zavsarlaga');
                                $hicheelleh_tsag = config('settings.huvaari_hicheelleh');

                                for($i = 1; $i <= $hicheelleh_tsag; $i++){

                                    if($i > 3){
                                        $ih_zasvar = $ihzasvar - $zavsar;
                                    }else{
                                        $ih_zasvar = 0;
                                    }

                                    $start = date("H:i", mktime($tsag, $minu + ($zavsar * ($i - 1)) + ($hicheelleh * ($i - 1)) + $ih_zasvar, 0, 0, 0, 2000));
                                    $end = date("H:i", mktime($tsag, $minu + ($zavsar * ($i - 1)) + ($hicheelleh * $i) + $ih_zasvar, 0, 0, 0, 2000));
                                ?>
                            <tr>
                                <td class="border border-b-1 bg-theme-2 text-center">
                                    <?=$i;?> - р цаг
                                    <div class="text-gray-600 text-xs whitespace-nowrap mt-0.5"><?=$start.' - '.$end;?></div>
                                </td>
                                <td class="border hover:bg-theme-31 border-b-2 text-center  table-1-{{$i}}" data-udur="1" data-number="{{$i}}" data-col="Даваа" data-row="{{$i}}-р цаг">
                                    <?php
                                    foreach($huvaariud as $huvaari):
                                        if($huvaari->udur == 1 && $huvaari->tsag == $i):
                                    ?>
                                    <div class="box-border p-1 bg-theme-12 zoom-in huvaari_view rounded">
                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'buten'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                        <?php }?>

                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'duuren'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                        <?php }elseif($huvaari->huvaari == 'dooguur' && $huvaari->type == 'duuren'){?>
                                            <div class="box-border p-1 bg-theme-9 rounded">
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                        </div>
                                        <? } ?>
                                        
                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'hagas'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="box-border p-1 bg-theme-9 rounded">
                                                <div class="font-medium text-base">Хичээлгүй</div>
                                            </div>
                                        <? } ?>

                                        <?php if($huvaari->huvaari == 'dooguur' && $huvaari->type == 'hagas'){?>
                                            <div class="font-medium text-base">Хичээлгүй</div>
                                            <div class="box-border p-1 bg-theme-9 rounded">
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                        </div>
                                        <? } ?>
                                        <div class="hidden hicheel_closed w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2">x</div>
                                    </div>
                                    <?php
                                        endif;
                                    endforeach;
                                    ?>
                                </td>
                                <td class="border hover:bg-theme-31 border-b-2 text-center  table-2-{{$i}}" data-udur="2" data-number="{{$i}}" data-col="Мягмар" data-row="{{$i}}-р цаг">
                                    <?php
                                    foreach($huvaariud as $huvaari):
                                        if($huvaari->udur == 2 && $huvaari->tsag == $i):
                                    ?>
                                    <div class="box-border p-1 bg-theme-12 zoom-in huvaari_view rounded">
                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'buten'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                        <?php }?>

                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'duuren'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                        <?php }elseif($huvaari->huvaari == 'dooguur' && $huvaari->type == 'duuren'){?>
                                            <div class="box-border p-1 bg-theme-9 rounded">
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                        </div>
                                        <? } ?>
                                        
                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'hagas'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="box-border p-1 bg-theme-9 rounded">
                                                <div class="font-medium text-base">Хичээлгүй</div>
                                            </div>
                                        <? } ?>

                                        <?php if($huvaari->huvaari == 'dooguur' && $huvaari->type == 'hagas'){?>
                                            <div class="font-medium text-base">Хичээлгүй</div>
                                            <div class="box-border p-1 bg-theme-9 rounded">
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                        </div>
                                        <? } ?>
                                        <div class="hidden hicheel_closed w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2">x</div>
                                    </div>
                                    <?php
                                        endif;
                                    endforeach;
                                    ?>
                                </td>
                                <td class="border hover:bg-theme-31 border-b-2 text-center  table-3-{{$i}}" data-udur="3" data-number="{{$i}}" data-col="Лхагва" data-row="{{$i}}-р цаг">
                                    <?php
                                    foreach($huvaariud as $huvaari):
                                        if($huvaari->udur == 3 && $huvaari->tsag == $i):
                                    ?>
                                    <div class="box-border p-1 bg-theme-12 zoom-in huvaari_view rounded">
                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'buten'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                        <?php }?>

                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'duuren'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                        <?php }elseif($huvaari->huvaari == 'dooguur' && $huvaari->type == 'duuren'){?>
                                            <div class="box-border p-1 bg-theme-9 rounded">
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                        </div>
                                        <? } ?>
                                        
                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'hagas'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="box-border p-1 bg-theme-9 rounded">
                                                <div class="font-medium text-base">Хичээлгүй</div>
                                            </div>
                                        <? } ?>

                                        <?php if($huvaari->huvaari == 'dooguur' && $huvaari->type == 'hagas'){?>
                                            <div class="font-medium text-base">Хичээлгүй</div>
                                            <div class="box-border p-1 bg-theme-9 rounded">
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                        </div>
                                        <? } ?>
                                        <div class="hidden hicheel_closed w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2">x</div>
                                    </div>
                                    <?php
                                        endif;
                                    endforeach;
                                    ?>
                                </td>
                                <td class="border hover:bg-theme-31 border-b-2 text-center  table-4-{{$i}}" data-udur="4" data-number="{{$i}}" data-col="Пүрэв" data-row="{{$i}}-р цаг">
                                    <?php
                                    foreach($huvaariud as $huvaari):
                                        if($huvaari->udur == 4 && $huvaari->tsag == $i):
                                    ?>
                                    <div class="box-border p-1 bg-theme-12 zoom-in huvaari_view rounded">
                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'buten'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                        <?php }?>

                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'duuren'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                        <?php }elseif($huvaari->huvaari == 'dooguur' && $huvaari->type == 'duuren'){?>
                                            <div class="box-border p-1 bg-theme-9 rounded">
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                        </div>
                                        <? } ?>
                                        
                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'hagas'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="box-border p-1 bg-theme-9 rounded">
                                                <div class="font-medium text-base">Хичээлгүй</div>
                                            </div>
                                        <? } ?>

                                        <?php if($huvaari->huvaari == 'dooguur' && $huvaari->type == 'hagas'){?>
                                            <div class="font-medium text-base">Хичээлгүй</div>
                                            <div class="box-border p-1 bg-theme-9 rounded">
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                        </div>
                                        <? } ?>
                                        <div class="hidden hicheel_closed w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2">x</div>
                                    </div>
                                    <?php
                                        endif;
                                    endforeach;
                                    ?>
                                </td>
                                <td class="border hover:bg-theme-31 border-b-2 text-center  table-5-{{$i}}" data-udur="5" data-number="{{$i}}" data-col="Баасан" data-row="{{$i}}-р цаг">
                                    <?php
                                    foreach($huvaariud as $huvaari):
                                        if($huvaari->udur == 5 && $huvaari->tsag == $i):
                                    ?>
                                    <div class="box-border p-1 bg-theme-12 zoom-in huvaari_view rounded">
                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'buten'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                        <?php }?>

                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'duuren'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                        <?php }elseif($huvaari->huvaari == 'dooguur' && $huvaari->type == 'duuren'){?>
                                            <div class="box-border p-1 bg-theme-9 rounded">
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                        </div>
                                        <? } ?>
                                        
                                        <?php if($huvaari->huvaari == 'deeguur' && $huvaari->type == 'hagas'){?>
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                            <div class="box-border p-1 bg-theme-9 rounded">
                                                <div class="font-medium text-base">Хичээлгүй</div>
                                            </div>
                                        <? } ?>

                                        <?php if($huvaari->huvaari == 'dooguur' && $huvaari->type == 'hagas'){?>
                                            <div class="font-medium text-base">Хичээлгүй</div>
                                            <div class="box-border p-1 bg-theme-9 rounded">
                                            <div class="font-medium text-base"><?=($huvaari->f_id == 0)? '' : $huvaari->hicheel;?><?=($huvaari->angi == 0)? '' : '/'.$huvaari->angi?></div>
                                        </div>
                                        <? } ?>
                                        <div class="hidden hicheel_closed w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2">x</div>
                                    </div>
                                    <?php
                                        endif;
                                    endforeach;
                                    ?>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
            
                </div>
            </div>
            
        </div>
    </div>
    <!-- END: Huvaari bagsh -->

@endsection

@section('style')
@endsection

@section('script')
@endsection