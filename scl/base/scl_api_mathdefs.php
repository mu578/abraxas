<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_api_mathdefs.php
//
// Copyright (C) 2017-2018 mu578. All rights reserved.
//
 
/*!
 * @project    Abraxas (Container Library).
 * @brief      The Math numerics library declares a set of functions to compute 
 *             common mathematical operations and transformations on 
 *             integral, real-floating-point and complex type (@todo rational numbers support).
 * @author     mu578 2018.
 * @maintainer mu578 2018.
 *
 * @copyright  (C) mu578. All rights reserved.
 */

namespace
{
	if (\intval(PHP_MAJOR_VERSION . PHP_MINOR_VERSION . PHP_RELEASE_VERSION) < 7200) {
		define('PHP_FLOAT_EPSILON', \floatval(1E-5));
		define('PHP_FLOAT_MIN'    , \floatval(1E-37));
		define('PHP_FLOAT_MAX'    , \floatval(1E+37));
	}
} /* EONS */

namespace std
{
	const _N_pow2_tab = [ 
		  0    => 1
		, 1    => 2                    , 2    => 4                    , 3    => 8
		, 4    => 16                   , 5    => 32                   , 6    => 64
		, 7    => 128                  , 8    => 256                  , 9    => 512
		, 10   => 1024                 , 11   => 2048                 , 12   => 4096
		, 13   => 8192                 , 14   => 16384                , 15   => 32768
		, 16   => 65536                , 17   => 131072               , 18   => 262144
		, 19   => 524288               , 20   => 1048576              , 21   => 2097152
		, 22   => 4194304              , 23   => 8388608              , 24   => 16777216
		, 25   => 33554432             , 26   => 67108864             , 27   => 134217728
		, 28   => 268435456            , 29   => 536870912            , 30   => 1073741824
		, 31   => 2147483648           , 32   => 4294967296           , 33   => 8589934592
		, 34   => 17179869184          , 35   => 34359738368          , 36   => 68719476736
		, 37   => 137438953472         , 38   => 274877906944         , 39   => 549755813888
		, 40   => 1099511627776        , 41   => 2199023255552        , 42   => 4398046511104
		, 43   => 8796093022208        , 44   => 17592186044416       , 45   => 35184372088832
		, 46   => 70368744177664       , 47   => 1.4073748835533E+14  , 48   => 2.8147497671066E+14
		, 49   => 5.6294995342131E+14  , 50   => 1.1258999068426E+15  , 51   => 2.2517998136852E+15
		, 52   => 4.5035996273705E+15  , 53   => 9.007199254741E+15   , 54   => 1.8014398509482E+16
		, 55   => 3.6028797018964E+16  , 56   => 7.2057594037928E+16  , 57   => 1.4411518807586E+17
		, 58   => 2.8823037615171E+17  , 59   => 5.7646075230342E+17  , 60   => 1.1529215046068E+18
		, 61   => 2.3058430092137E+18  , 62   => 4.6116860184274E+18  , 63   => 9.2233720368548E+18
		, 64   => 1.844674407371E+19   , 65   => 3.6893488147419E+19  , 66   => 7.3786976294838E+19
		, 67   => 1.4757395258968E+20  , 68   => 2.9514790517935E+20  , 69   => 5.9029581035871E+20
		, 70   => 1.1805916207174E+21  , 71   => 2.3611832414348E+21  , 72   => 4.7223664828696E+21
		, 73   => 9.4447329657393E+21  , 74   => 1.8889465931479E+22  , 75   => 3.7778931862957E+22
		, 76   => 7.5557863725914E+22  , 77   => 1.5111572745183E+23  , 78   => 3.0223145490366E+23
		, 79   => 6.0446290980731E+23  , 80   => 1.2089258196146E+24  , 81   => 2.4178516392293E+24
		, 82   => 4.8357032784585E+24  , 83   => 9.671406556917E+24   , 84   => 1.9342813113834E+25
		, 85   => 3.8685626227668E+25  , 86   => 7.7371252455336E+25  , 87   => 1.5474250491067E+26
		, 88   => 3.0948500982135E+26  , 89   => 6.1897001964269E+26  , 90   => 1.2379400392854E+27
		, 91   => 2.4758800785708E+27  , 92   => 4.9517601571415E+27  , 93   => 9.903520314283E+27
		, 94   => 1.9807040628566E+28  , 95   => 3.9614081257132E+28  , 96   => 7.9228162514264E+28
		, 97   => 1.5845632502853E+29  , 98   => 3.1691265005706E+29  , 99   => 6.3382530011411E+29
		, 100  => 1.2676506002282E+30  , 101  => 2.5353012004565E+30  , 102  => 5.0706024009129E+30
		, 103  => 1.0141204801826E+31  , 104  => 2.0282409603652E+31  , 105  => 4.0564819207303E+31
		, 106  => 8.1129638414607E+31  , 107  => 1.6225927682921E+32  , 108  => 3.2451855365843E+32
		, 109  => 6.4903710731685E+32  , 110  => 1.2980742146337E+33  , 111  => 2.5961484292674E+33
		, 112  => 5.1922968585348E+33  , 113  => 1.038459371707E+34   , 114  => 2.0769187434139E+34
		, 115  => 4.1538374868279E+34  , 116  => 8.3076749736557E+34  , 117  => 1.6615349947311E+35
		, 118  => 3.3230699894623E+35  , 119  => 6.6461399789246E+35  , 120  => 1.3292279957849E+36
		, 121  => 2.6584559915698E+36  , 122  => 5.3169119831397E+36  , 123  => 1.0633823966279E+37
		, 124  => 2.1267647932559E+37  , 125  => 4.2535295865117E+37  , 126  => 8.5070591730235E+37
		, 127  => 1.7014118346047E+38  , 128  => 3.4028236692094E+38  , 129  => 6.8056473384188E+38
		, 130  => 1.3611294676838E+39  , 131  => 2.7222589353675E+39  , 132  => 5.444517870735E+39
		, 133  => 1.088903574147E+40   , 134  => 2.177807148294E+40   , 135  => 4.355614296588E+40
		, 136  => 8.711228593176E+40   , 137  => 1.7422457186352E+41  , 138  => 3.4844914372704E+41
		, 139  => 6.9689828745408E+41  , 140  => 1.3937965749082E+42  , 141  => 2.7875931498163E+42
		, 142  => 5.5751862996327E+42  , 143  => 1.1150372599265E+43  , 144  => 2.2300745198531E+43
		, 145  => 4.4601490397061E+43  , 146  => 8.9202980794122E+43  , 147  => 1.7840596158824E+44
		, 148  => 3.5681192317649E+44  , 149  => 7.1362384635298E+44  , 150  => 1.427247692706E+45
		, 151  => 2.8544953854119E+45  , 152  => 5.7089907708238E+45  , 153  => 1.1417981541648E+46
		, 154  => 2.2835963083295E+46  , 155  => 4.5671926166591E+46  , 156  => 9.1343852333181E+46
		, 157  => 1.8268770466636E+47  , 158  => 3.6537540933273E+47  , 159  => 7.3075081866545E+47
		, 160  => 1.4615016373309E+48  , 161  => 2.9230032746618E+48  , 162  => 5.8460065493236E+48
		, 163  => 1.1692013098647E+49  , 164  => 2.3384026197294E+49  , 165  => 4.6768052394589E+49
		, 166  => 9.3536104789178E+49  , 167  => 1.8707220957836E+50  , 168  => 3.7414441915671E+50
		, 169  => 7.4828883831342E+50  , 170  => 1.4965776766268E+51  , 171  => 2.9931553532537E+51
		, 172  => 5.9863107065074E+51  , 173  => 1.1972621413015E+52  , 174  => 2.394524282603E+52
		, 175  => 4.7890485652059E+52  , 176  => 9.5780971304118E+52  , 177  => 1.9156194260824E+53
		, 178  => 3.8312388521647E+53  , 179  => 7.6624777043294E+53  , 180  => 1.5324955408659E+54
		, 181  => 3.0649910817318E+54  , 182  => 6.1299821634636E+54  , 183  => 1.2259964326927E+55
		, 184  => 2.4519928653854E+55  , 185  => 4.9039857307708E+55  , 186  => 9.8079714615417E+55
		, 187  => 1.9615942923083E+56  , 188  => 3.9231885846167E+56  , 189  => 7.8463771692334E+56
		, 190  => 1.5692754338467E+57  , 191  => 3.1385508676933E+57  , 192  => 6.2771017353867E+57
		, 193  => 1.2554203470773E+58  , 194  => 2.5108406941547E+58  , 195  => 5.0216813883093E+58
		, 196  => 1.0043362776619E+59  , 197  => 2.0086725553237E+59  , 198  => 4.0173451106475E+59
		, 199  => 8.034690221295E+59   , 200  => 1.606938044259E+60   , 201  => 3.213876088518E+60
		, 202  => 6.427752177036E+60   , 203  => 1.2855504354072E+61  , 204  => 2.5711008708144E+61
		, 205  => 5.1422017416288E+61  , 206  => 1.0284403483258E+62  , 207  => 2.0568806966515E+62
		, 208  => 4.113761393303E+62   , 209  => 8.227522786606E+62   , 210  => 1.6455045573212E+63
		, 211  => 3.2910091146424E+63  , 212  => 6.5820182292848E+63  , 213  => 1.316403645857E+64
		, 214  => 2.6328072917139E+64  , 215  => 5.2656145834279E+64  , 216  => 1.0531229166856E+65
		, 217  => 2.1062458333711E+65  , 218  => 4.2124916667423E+65  , 219  => 8.4249833334846E+65
		, 220  => 1.6849966666969E+66  , 221  => 3.3699933333938E+66  , 222  => 6.7399866667877E+66
		, 223  => 1.3479973333575E+67  , 224  => 2.6959946667151E+67  , 225  => 5.3919893334301E+67
		, 226  => 1.078397866686E+68   , 227  => 2.1567957333721E+68  , 228  => 4.3135914667441E+68
		, 229  => 8.6271829334882E+68  , 230  => 1.7254365866976E+69  , 231  => 3.4508731733953E+69
		, 232  => 6.9017463467906E+69  , 233  => 1.3803492693581E+70  , 234  => 2.7606985387162E+70
		, 235  => 5.5213970774325E+70  , 236  => 1.1042794154865E+71  , 237  => 2.208558830973E+71
		, 238  => 4.417117661946E+71   , 239  => 8.8342353238919E+71  , 240  => 1.7668470647784E+72
		, 241  => 3.5336941295568E+72  , 242  => 7.0673882591135E+72  , 243  => 1.4134776518227E+73
		, 244  => 2.8269553036454E+73  , 245  => 5.6539106072908E+73  , 246  => 1.1307821214582E+74
		, 247  => 2.2615642429163E+74  , 248  => 4.5231284858327E+74  , 249  => 9.0462569716653E+74
		, 250  => 1.8092513943331E+75  , 251  => 3.6185027886661E+75  , 252  => 7.2370055773323E+75
		, 253  => 1.4474011154665E+76  , 254  => 2.8948022309329E+76  , 255  => 5.7896044618658E+76
		, 256  => 1.1579208923732E+77  , 257  => 2.3158417847463E+77  , 258  => 4.6316835694926E+77
		, 259  => 9.2633671389853E+77  , 260  => 1.8526734277971E+78  , 261  => 3.7053468555941E+78
		, 262  => 7.4106937111882E+78  , 263  => 1.4821387422376E+79  , 264  => 2.9642774844753E+79
		, 265  => 5.9285549689506E+79  , 266  => 1.1857109937901E+80  , 267  => 2.3714219875802E+80
		, 268  => 4.7428439751605E+80  , 269  => 9.4856879503209E+80  , 270  => 1.8971375900642E+81
		, 271  => 3.7942751801284E+81  , 272  => 7.5885503602568E+81  , 273  => 1.5177100720514E+82
		, 274  => 3.0354201441027E+82  , 275  => 6.0708402882054E+82  , 276  => 1.2141680576411E+83
		, 277  => 2.4283361152822E+83  , 278  => 4.8566722305643E+83  , 279  => 9.7133444611286E+83
		, 280  => 1.9426688922257E+84  , 281  => 3.8853377844515E+84  , 282  => 7.7706755689029E+84
		, 283  => 1.5541351137806E+85  , 284  => 3.1082702275612E+85  , 285  => 6.2165404551223E+85
		, 286  => 1.2433080910245E+86  , 287  => 2.4866161820489E+86  , 288  => 4.9732323640979E+86
		, 289  => 9.9464647281957E+86  , 290  => 1.9892929456391E+87  , 291  => 3.9785858912783E+87
		, 292  => 7.9571717825566E+87  , 293  => 1.5914343565113E+88  , 294  => 3.1828687130226E+88
		, 295  => 6.3657374260453E+88  , 296  => 1.2731474852091E+89  , 297  => 2.5462949704181E+89
		, 298  => 5.0925899408362E+89  , 299  => 1.0185179881672E+90  , 300  => 2.0370359763345E+90
		, 301  => 4.074071952669E+90   , 302  => 8.1481439053379E+90  , 303  => 1.6296287810676E+91
		, 304  => 3.2592575621352E+91  , 305  => 6.5185151242704E+91  , 306  => 1.3037030248541E+92
		, 307  => 2.6074060497081E+92  , 308  => 5.2148120994163E+92  , 309  => 1.0429624198833E+93
		, 310  => 2.0859248397665E+93  , 311  => 4.171849679533E+93   , 312  => 8.3436993590661E+93
		, 313  => 1.6687398718132E+94  , 314  => 3.3374797436264E+94  , 315  => 6.6749594872528E+94
		, 316  => 1.3349918974506E+95  , 317  => 2.6699837949011E+95  , 318  => 5.3399675898023E+95
		, 319  => 1.0679935179605E+96  , 320  => 2.1359870359209E+96  , 321  => 4.2719740718418E+96
		, 322  => 8.5439481436836E+96  , 323  => 1.7087896287367E+97  , 324  => 3.4175792574735E+97
		, 325  => 6.8351585149469E+97  , 326  => 1.3670317029894E+98  , 327  => 2.7340634059788E+98
		, 328  => 5.4681268119575E+98  , 329  => 1.0936253623915E+99  , 330  => 2.187250724783E+99
		, 331  => 4.374501449566E+99   , 332  => 8.749002899132E+99   , 333  => 1.7498005798264E+100
		, 334  => 3.4996011596528E+100 , 335  => 6.9992023193056E+100 , 336  => 1.3998404638611E+101
		, 337  => 2.7996809277223E+101 , 338  => 5.5993618554445E+101 , 339  => 1.1198723710889E+102
		, 340  => 2.2397447421778E+102 , 341  => 4.4794894843556E+102 , 342  => 8.9589789687112E+102
		, 343  => 1.7917957937422E+103 , 344  => 3.5835915874845E+103 , 345  => 7.167183174969E+103
		, 346  => 1.4334366349938E+104 , 347  => 2.8668732699876E+104 , 348  => 5.7337465399752E+104
		, 349  => 1.146749307995E+105  , 350  => 2.2934986159901E+105 , 351  => 4.5869972319801E+105
		, 352  => 9.1739944639603E+105 , 353  => 1.8347988927921E+106 , 354  => 3.6695977855841E+106
		, 355  => 7.3391955711682E+106 , 356  => 1.4678391142336E+107 , 357  => 2.9356782284673E+107
		, 358  => 5.8713564569346E+107 , 359  => 1.1742712913869E+108 , 360  => 2.3485425827738E+108
		, 361  => 4.6970851655477E+108 , 362  => 9.3941703310953E+108 , 363  => 1.8788340662191E+109
		, 364  => 3.7576681324381E+109 , 365  => 7.5153362648763E+109 , 366  => 1.5030672529753E+110
		, 367  => 3.0061345059505E+110 , 368  => 6.012269011901E+110  , 369  => 1.2024538023802E+111
		, 370  => 2.4049076047604E+111 , 371  => 4.8098152095208E+111 , 372  => 9.6196304190416E+111
		, 373  => 1.9239260838083E+112 , 374  => 3.8478521676166E+112 , 375  => 7.6957043352333E+112
		, 376  => 1.5391408670467E+113 , 377  => 3.0782817340933E+113 , 378  => 6.1565634681866E+113
		, 379  => 1.2313126936373E+114 , 380  => 2.4626253872747E+114 , 381  => 4.9252507745493E+114
		, 382  => 9.8505015490986E+114 , 383  => 1.9701003098197E+115 , 384  => 3.9402006196394E+115
		, 385  => 7.8804012392789E+115 , 386  => 1.5760802478558E+116 , 387  => 3.1521604957116E+116
		, 388  => 6.3043209914231E+116 , 389  => 1.2608641982846E+117 , 390  => 2.5217283965692E+117
		, 391  => 5.0434567931385E+117 , 392  => 1.0086913586277E+118 , 393  => 2.0173827172554E+118
		, 394  => 4.0347654345108E+118 , 395  => 8.0695308690216E+118 , 396  => 1.6139061738043E+119
		, 397  => 3.2278123476086E+119 , 398  => 6.4556246952173E+119 , 399  => 1.2911249390435E+120
		, 400  => 2.5822498780869E+120 , 401  => 5.1644997561738E+120 , 402  => 1.0328999512348E+121
		, 403  => 2.0657999024695E+121 , 404  => 4.1315998049391E+121 , 405  => 8.2631996098781E+121
		, 406  => 1.6526399219756E+122 , 407  => 3.3052798439512E+122 , 408  => 6.6105596879025E+122
		, 409  => 1.3221119375805E+123 , 410  => 2.644223875161E+123  , 411  => 5.288447750322E+123
		, 412  => 1.0576895500644E+124 , 413  => 2.1153791001288E+124 , 414  => 4.2307582002576E+124
		, 415  => 8.4615164005152E+124 , 416  => 1.692303280103E+125  , 417  => 3.3846065602061E+125
		, 418  => 6.7692131204121E+125 , 419  => 1.3538426240824E+126 , 420  => 2.7076852481649E+126
		, 421  => 5.4153704963297E+126 , 422  => 1.0830740992659E+127 , 423  => 2.1661481985319E+127
		, 424  => 4.3322963970638E+127 , 425  => 8.6645927941275E+127 , 426  => 1.7329185588255E+128
		, 427  => 3.465837117651E+128  , 428  => 6.931674235302E+128  , 429  => 1.3863348470604E+129
		, 430  => 2.7726696941208E+129 , 431  => 5.5453393882416E+129 , 432  => 1.1090678776483E+130
		, 433  => 2.2181357552967E+130 , 434  => 4.4362715105933E+130 , 435  => 8.8725430211866E+130
		, 436  => 1.7745086042373E+131 , 437  => 3.5490172084746E+131 , 438  => 7.0980344169493E+131
		, 439  => 1.4196068833899E+132 , 440  => 2.8392137667797E+132 , 441  => 5.6784275335594E+132
		, 442  => 1.1356855067119E+133 , 443  => 2.2713710134238E+133 , 444  => 4.5427420268475E+133
		, 445  => 9.0854840536951E+133 , 446  => 1.817096810739E+134  , 447  => 3.634193621478E+134
		, 448  => 7.2683872429561E+134 , 449  => 1.4536774485912E+135 , 450  => 2.9073548971824E+135
		, 451  => 5.8147097943649E+135 , 452  => 1.162941958873E+136  , 453  => 2.3258839177459E+136
		, 454  => 4.6517678354919E+136 , 455  => 9.3035356709838E+136 , 456  => 1.8607071341968E+137
		, 457  => 3.7214142683935E+137 , 458  => 7.442828536787E+137  , 459  => 1.4885657073574E+138
		, 460  => 2.9771314147148E+138 , 461  => 5.9542628294296E+138 , 462  => 1.1908525658859E+139
		, 463  => 2.3817051317718E+139 , 464  => 4.7634102635437E+139 , 465  => 9.5268205270874E+139
		, 466  => 1.9053641054175E+140 , 467  => 3.810728210835E+140  , 468  => 7.6214564216699E+140
		, 469  => 1.524291284334E+141  , 470  => 3.048582568668E+141  , 471  => 6.0971651373359E+141
		, 472  => 1.2194330274672E+142 , 473  => 2.4388660549344E+142 , 474  => 4.8777321098687E+142
		, 475  => 9.7554642197375E+142 , 476  => 1.9510928439475E+143 , 477  => 3.902185687895E+143
		, 478  => 7.80437137579E+143   , 479  => 1.560874275158E+144  , 480  => 3.121748550316E+144
		, 481  => 6.243497100632E+144  , 482  => 1.2486994201264E+145 , 483  => 2.4973988402528E+145
		, 484  => 4.9947976805056E+145 , 485  => 9.9895953610112E+145 , 486  => 1.9979190722022E+146
		, 487  => 3.9958381444045E+146 , 488  => 7.9916762888089E+146 , 489  => 1.5983352577618E+147
		, 490  => 3.1966705155236E+147 , 491  => 6.3933410310472E+147 , 492  => 1.2786682062094E+148
		, 493  => 2.5573364124189E+148 , 494  => 5.1146728248377E+148 , 495  => 1.0229345649675E+149
		, 496  => 2.0458691299351E+149 , 497  => 4.0917382598702E+149 , 498  => 8.1834765197404E+149
		, 499  => 1.6366953039481E+150 , 500  => 3.2733906078961E+150 , 501  => 6.5467812157923E+150
		, 502  => 1.3093562431585E+151 , 503  => 2.6187124863169E+151 , 504  => 5.2374249726338E+151
		, 505  => 1.0474849945268E+152 , 506  => 2.0949699890535E+152 , 507  => 4.1899399781071E+152
		, 508  => 8.3798799562141E+152 , 509  => 1.6759759912428E+153 , 510  => 3.3519519824856E+153
		, 511  => 6.7039039649713E+153 , 512  => 1.3407807929943E+154 , 513  => 2.6815615859885E+154
		, 514  => 5.363123171977E+154  , 515  => 1.0726246343954E+155 , 516  => 2.1452492687908E+155
		, 517  => 4.2904985375816E+155 , 518  => 8.5809970751633E+155 , 519  => 1.7161994150327E+156
		, 520  => 3.4323988300653E+156 , 521  => 6.8647976601306E+156 , 522  => 1.3729595320261E+157
		, 523  => 2.7459190640522E+157 , 524  => 5.4918381281045E+157 , 525  => 1.0983676256209E+158
		, 526  => 2.1967352512418E+158 , 527  => 4.3934705024836E+158 , 528  => 8.7869410049672E+158
		, 529  => 1.7573882009934E+159 , 530  => 3.5147764019869E+159 , 531  => 7.0295528039737E+159
		, 532  => 1.4059105607947E+160 , 533  => 2.8118211215895E+160 , 534  => 5.623642243179E+160
		, 535  => 1.1247284486358E+161 , 536  => 2.2494568972716E+161 , 537  => 4.4989137945432E+161
		, 538  => 8.9978275890864E+161 , 539  => 1.7995655178173E+162 , 540  => 3.5991310356346E+162
		, 541  => 7.1982620712691E+162 , 542  => 1.4396524142538E+163 , 543  => 2.8793048285076E+163
		, 544  => 5.7586096570153E+163 , 545  => 1.1517219314031E+164 , 546  => 2.3034438628061E+164
		, 547  => 4.6068877256122E+164 , 548  => 9.2137754512245E+164 , 549  => 1.8427550902449E+165
		, 550  => 3.6855101804898E+165 , 551  => 7.3710203609796E+165 , 552  => 1.4742040721959E+166
		, 553  => 2.9484081443918E+166 , 554  => 5.8968162887837E+166 , 555  => 1.1793632577567E+167
		, 556  => 2.3587265155135E+167 , 557  => 4.7174530310269E+167 , 558  => 9.4349060620539E+167
		, 559  => 1.8869812124108E+168 , 560  => 3.7739624248215E+168 , 561  => 7.5479248496431E+168
		, 562  => 1.5095849699286E+169 , 563  => 3.0191699398572E+169 , 564  => 6.0383398797145E+169
		, 565  => 1.2076679759429E+170 , 566  => 2.4153359518858E+170 , 567  => 4.8306719037716E+170
		, 568  => 9.6613438075431E+170 , 569  => 1.9322687615086E+171 , 570  => 3.8645375230173E+171
		, 571  => 7.7290750460345E+171 , 572  => 1.5458150092069E+172 , 573  => 3.0916300184138E+172
		, 574  => 6.1832600368276E+172 , 575  => 1.2366520073655E+173 , 576  => 2.473304014731E+173
		, 577  => 4.9466080294621E+173 , 578  => 9.8932160589242E+173 , 579  => 1.9786432117848E+174
		, 580  => 3.9572864235697E+174 , 581  => 7.9145728471393E+174 , 582  => 1.5829145694279E+175
		, 583  => 3.1658291388557E+175 , 584  => 6.3316582777115E+175 , 585  => 1.2663316555423E+176
		, 586  => 2.5326633110846E+176 , 587  => 5.0653266221692E+176 , 588  => 1.0130653244338E+177
		, 589  => 2.0261306488677E+177 , 590  => 4.0522612977353E+177 , 591  => 8.1045225954707E+177
		, 592  => 1.6209045190941E+178 , 593  => 3.2418090381883E+178 , 594  => 6.4836180763766E+178
		, 595  => 1.2967236152753E+179 , 596  => 2.5934472305506E+179 , 597  => 5.1868944611012E+179
		, 598  => 1.0373788922202E+180 , 599  => 2.0747577844405E+180 , 600  => 4.149515568881E+180
		, 601  => 8.299031137762E+180  , 602  => 1.6598062275524E+181 , 603  => 3.3196124551048E+181
		, 604  => 6.6392249102096E+181 , 605  => 1.3278449820419E+182 , 606  => 2.6556899640838E+182
		, 607  => 5.3113799281677E+182 , 608  => 1.0622759856335E+183 , 609  => 2.1245519712671E+183
		, 610  => 4.2491039425341E+183 , 611  => 8.4982078850683E+183 , 612  => 1.6996415770137E+184
		, 613  => 3.3992831540273E+184 , 614  => 6.7985663080546E+184 , 615  => 1.3597132616109E+185
		, 616  => 2.7194265232218E+185 , 617  => 5.4388530464437E+185 , 618  => 1.0877706092887E+186
		, 619  => 2.1755412185775E+186 , 620  => 4.351082437155E+186  , 621  => 8.7021648743099E+186
		, 622  => 1.740432974862E+187  , 623  => 3.480865949724E+187  , 624  => 6.9617318994479E+187
		, 625  => 1.3923463798896E+188 , 626  => 2.7846927597792E+188 , 627  => 5.5693855195583E+188
		, 628  => 1.1138771039117E+189 , 629  => 2.2277542078233E+189 , 630  => 4.4555084156467E+189
		, 631  => 8.9110168312934E+189 , 632  => 1.7822033662587E+190 , 633  => 3.5644067325173E+190
		, 634  => 7.1288134650347E+190 , 635  => 1.4257626930069E+191 , 636  => 2.8515253860139E+191
		, 637  => 5.7030507720277E+191 , 638  => 1.1406101544055E+192 , 639  => 2.2812203088111E+192
		, 640  => 4.5624406176222E+192 , 641  => 9.1248812352444E+192 , 642  => 1.8249762470489E+193
		, 643  => 3.6499524940978E+193 , 644  => 7.2999049881955E+193 , 645  => 1.4599809976391E+194
		, 646  => 2.9199619952782E+194 , 647  => 5.8399239905564E+194 , 648  => 1.1679847981113E+195
		, 649  => 2.3359695962226E+195 , 650  => 4.6719391924451E+195 , 651  => 9.3438783848903E+195
		, 652  => 1.8687756769781E+196 , 653  => 3.7375513539561E+196 , 654  => 7.4751027079122E+196
		, 655  => 1.4950205415824E+197 , 656  => 2.9900410831649E+197 , 657  => 5.9800821663298E+197
		, 658  => 1.196016433266E+198  , 659  => 2.3920328665319E+198 , 660  => 4.7840657330638E+198
		, 661  => 9.5681314661276E+198 , 662  => 1.9136262932255E+199 , 663  => 3.827252586451E+199
		, 664  => 7.6545051729021E+199 , 665  => 1.5309010345804E+200 , 666  => 3.0618020691608E+200
		, 667  => 6.1236041383217E+200 , 668  => 1.2247208276643E+201 , 669  => 2.4494416553287E+201
		, 670  => 4.8988833106573E+201 , 671  => 9.7977666213147E+201 , 672  => 1.9595533242629E+202
		, 673  => 3.9191066485259E+202 , 674  => 7.8382132970517E+202 , 675  => 1.5676426594103E+203
		, 676  => 3.1352853188207E+203 , 677  => 6.2705706376414E+203 , 678  => 1.2541141275283E+204
		, 679  => 2.5082282550566E+204 , 680  => 5.0164565101131E+204 , 681  => 1.0032913020226E+205
		, 682  => 2.0065826040452E+205 , 683  => 4.0131652080905E+205 , 684  => 8.026330416181E+205
		, 685  => 1.6052660832362E+206 , 686  => 3.2105321664724E+206 , 687  => 6.4210643329448E+206
		, 688  => 1.284212866589E+207  , 689  => 2.5684257331779E+207 , 690  => 5.1368514663558E+207
		, 691  => 1.0273702932712E+208 , 692  => 2.0547405865423E+208 , 693  => 4.1094811730847E+208
		, 694  => 8.2189623461693E+208 , 695  => 1.6437924692339E+209 , 696  => 3.2875849384677E+209
		, 697  => 6.5751698769355E+209 , 698  => 1.3150339753871E+210 , 699  => 2.6300679507742E+210
		, 700  => 5.2601359015484E+210 , 701  => 1.0520271803097E+211 , 702  => 2.1040543606193E+211
		, 703  => 4.2081087212387E+211 , 704  => 8.4162174424774E+211 , 705  => 1.6832434884955E+212
		, 706  => 3.366486976991E+212  , 707  => 6.7329739539819E+212 , 708  => 1.3465947907964E+213
		, 709  => 2.6931895815928E+213 , 710  => 5.3863791631855E+213 , 711  => 1.0772758326371E+214
		, 712  => 2.1545516652742E+214 , 713  => 4.3091033305484E+214 , 714  => 8.6182066610969E+214
		, 715  => 1.7236413322194E+215 , 716  => 3.4472826644387E+215 , 717  => 6.8945653288775E+215
		, 718  => 1.3789130657755E+216 , 719  => 2.757826131551E+216  , 720  => 5.515652263102E+216
		, 721  => 1.1031304526204E+217 , 722  => 2.2062609052408E+217 , 723  => 4.4125218104816E+217
		, 724  => 8.8250436209632E+217 , 725  => 1.7650087241926E+218 , 726  => 3.5300174483853E+218
		, 727  => 7.0600348967705E+218 , 728  => 1.4120069793541E+219 , 729  => 2.8240139587082E+219
		, 730  => 5.6480279174164E+219 , 731  => 1.1296055834833E+220 , 732  => 2.2592111669666E+220
		, 733  => 4.5184223339331E+220 , 734  => 9.0368446678663E+220 , 735  => 1.8073689335733E+221
		, 736  => 3.6147378671465E+221 , 737  => 7.229475734293E+221  , 738  => 1.4458951468586E+222
		, 739  => 2.8917902937172E+222 , 740  => 5.7835805874344E+222 , 741  => 1.1567161174869E+223
		, 742  => 2.3134322349738E+223 , 743  => 4.6268644699475E+223 , 744  => 9.2537289398951E+223
		, 745  => 1.850745787979E+224  , 746  => 3.701491575958E+224  , 747  => 7.4029831519161E+224
		, 748  => 1.4805966303832E+225 , 749  => 2.9611932607664E+225 , 750  => 5.9223865215329E+225
		, 751  => 1.1844773043066E+226 , 752  => 2.3689546086131E+226 , 753  => 4.7379092172263E+226
		, 754  => 9.4758184344526E+226 , 755  => 1.8951636868905E+227 , 756  => 3.790327373781E+227
		, 757  => 7.5806547475621E+227 , 758  => 1.5161309495124E+228 , 759  => 3.0322618990248E+228
		, 760  => 6.0645237980496E+228 , 761  => 1.2129047596099E+229 , 762  => 2.4258095192199E+229
		, 763  => 4.8516190384397E+229 , 764  => 9.7032380768794E+229 , 765  => 1.9406476153759E+230
		, 766  => 3.8812952307518E+230 , 767  => 7.7625904615035E+230 , 768  => 1.5525180923007E+231
		, 769  => 3.1050361846014E+231 , 770  => 6.2100723692028E+231 , 771  => 1.2420144738406E+232
		, 772  => 2.4840289476811E+232 , 773  => 4.9680578953623E+232 , 774  => 9.9361157907245E+232
		, 775  => 1.9872231581449E+233 , 776  => 3.9744463162898E+233 , 777  => 7.9488926325796E+233
		, 778  => 1.5897785265159E+234 , 779  => 3.1795570530319E+234 , 780  => 6.3591141060637E+234
		, 781  => 1.2718228212127E+235 , 782  => 2.5436456424255E+235 , 783  => 5.087291284851E+235
		, 784  => 1.0174582569702E+236 , 785  => 2.0349165139404E+236 , 786  => 4.0698330278808E+236
		, 787  => 8.1396660557615E+236 , 788  => 1.6279332111523E+237 , 789  => 3.2558664223046E+237
		, 790  => 6.5117328446092E+237 , 791  => 1.3023465689218E+238 , 792  => 2.6046931378437E+238
		, 793  => 5.2093862756874E+238 , 794  => 1.0418772551375E+239 , 795  => 2.083754510275E+239
		, 796  => 4.1675090205499E+239 , 797  => 8.3350180410998E+239 , 798  => 1.66700360822E+240
		, 799  => 3.3340072164399E+240 , 800  => 6.6680144328799E+240 , 801  => 1.333602886576E+241
		, 802  => 2.6672057731519E+241 , 803  => 5.3344115463039E+241 , 804  => 1.0668823092608E+242
		, 805  => 2.1337646185216E+242 , 806  => 4.2675292370431E+242 , 807  => 8.5350584740862E+242
		, 808  => 1.7070116948172E+243 , 809  => 3.4140233896345E+243 , 810  => 6.828046779269E+243
		, 811  => 1.3656093558538E+244 , 812  => 2.7312187117076E+244 , 813  => 5.4624374234152E+244
		, 814  => 1.092487484683E+245  , 815  => 2.1849749693661E+245 , 816  => 4.3699499387321E+245
		, 817  => 8.7398998774643E+245 , 818  => 1.7479799754929E+246 , 819  => 3.4959599509857E+246
		, 820  => 6.9919199019714E+246 , 821  => 1.3983839803943E+247 , 822  => 2.7967679607886E+247
		, 823  => 5.5935359215771E+247 , 824  => 1.1187071843154E+248 , 825  => 2.2374143686309E+248
		, 826  => 4.4748287372617E+248 , 827  => 8.9496574745234E+248 , 828  => 1.7899314949047E+249
		, 829  => 3.5798629898094E+249 , 830  => 7.1597259796187E+249 , 831  => 1.4319451959237E+250
		, 832  => 2.8638903918475E+250 , 833  => 5.727780783695E+250  , 834  => 1.145556156739E+251
		, 835  => 2.291112313478E+251  , 836  => 4.582224626956E+251  , 837  => 9.164449253912E+251
		, 838  => 1.8328898507824E+252 , 839  => 3.6657797015648E+252 , 840  => 7.3315594031296E+252
		, 841  => 1.4663118806259E+253 , 842  => 2.9326237612518E+253 , 843  => 5.8652475225037E+253
		, 844  => 1.1730495045007E+254 , 845  => 2.3460990090015E+254 , 846  => 4.6921980180029E+254
		, 847  => 9.3843960360059E+254 , 848  => 1.8768792072012E+255 , 849  => 3.7537584144024E+255
		, 850  => 7.5075168288047E+255 , 851  => 1.5015033657609E+256 , 852  => 3.0030067315219E+256
		, 853  => 6.0060134630438E+256 , 854  => 1.2012026926088E+257 , 855  => 2.4024053852175E+257
		, 856  => 4.804810770435E+257  , 857  => 9.60962154087E+257   , 858  => 1.921924308174E+258
		, 859  => 3.843848616348E+258  , 860  => 7.687697232696E+258  , 861  => 1.5375394465392E+259
		, 862  => 3.0750788930784E+259 , 863  => 6.1501577861568E+259 , 864  => 1.2300315572314E+260
		, 865  => 2.4600631144627E+260 , 866  => 4.9201262289254E+260 , 867  => 9.8402524578509E+260
		, 868  => 1.9680504915702E+261 , 869  => 3.9361009831404E+261 , 870  => 7.8722018662807E+261
		, 871  => 1.5744403932561E+262 , 872  => 3.1488807865123E+262 , 873  => 6.2977615730246E+262
		, 874  => 1.2595523146049E+263 , 875  => 2.5191046292098E+263 , 876  => 5.0382092584197E+263
		, 877  => 1.0076418516839E+264 , 878  => 2.0152837033679E+264 , 879  => 4.0305674067357E+264
		, 880  => 8.0611348134715E+264 , 881  => 1.6122269626943E+265 , 882  => 3.2244539253886E+265
		, 883  => 6.4489078507772E+265 , 884  => 1.2897815701554E+266 , 885  => 2.5795631403109E+266
		, 886  => 5.1591262806217E+266 , 887  => 1.0318252561243E+267 , 888  => 2.0636505122487E+267
		, 889  => 4.1273010244974E+267 , 890  => 8.2546020489948E+267 , 891  => 1.650920409799E+268
		, 892  => 3.3018408195979E+268 , 893  => 6.6036816391958E+268 , 894  => 1.3207363278392E+269
		, 895  => 2.6414726556783E+269 , 896  => 5.2829453113567E+269 , 897  => 1.0565890622713E+270
		, 898  => 2.1131781245427E+270 , 899  => 4.2263562490853E+270 , 900  => 8.4527124981706E+270
		, 901  => 1.6905424996341E+271 , 902  => 3.3810849992683E+271 , 903  => 6.7621699985365E+271
		, 904  => 1.3524339997073E+272 , 905  => 2.7048679994146E+272 , 906  => 5.4097359988292E+272
		, 907  => 1.0819471997658E+273 , 908  => 2.1638943995317E+273 , 909  => 4.3277887990634E+273
		, 910  => 8.6555775981267E+273 , 911  => 1.7311155196253E+274 , 912  => 3.4622310392507E+274
		, 913  => 6.9244620785014E+274 , 914  => 1.3848924157003E+275 , 915  => 2.7697848314006E+275
		, 916  => 5.5395696628011E+275 , 917  => 1.1079139325602E+276 , 918  => 2.2158278651204E+276
		, 919  => 4.4316557302409E+276 , 920  => 8.8633114604818E+276 , 921  => 1.7726622920964E+277
		, 922  => 3.5453245841927E+277 , 923  => 7.0906491683854E+277 , 924  => 1.4181298336771E+278
		, 925  => 2.8362596673542E+278 , 926  => 5.6725193347083E+278 , 927  => 1.1345038669417E+279
		, 928  => 2.2690077338833E+279 , 929  => 4.5380154677667E+279 , 930  => 9.0760309355333E+279
		, 931  => 1.8152061871067E+280 , 932  => 3.6304123742133E+280 , 933  => 7.2608247484267E+280
		, 934  => 1.4521649496853E+281 , 935  => 2.9043298993707E+281 , 936  => 5.8086597987413E+281
		, 937  => 1.1617319597483E+282 , 938  => 2.3234639194965E+282 , 939  => 4.6469278389931E+282
		, 940  => 9.2938556779861E+282 , 941  => 1.8587711355972E+283 , 942  => 3.7175422711945E+283
		, 943  => 7.4350845423889E+283 , 944  => 1.4870169084778E+284 , 945  => 2.9740338169556E+284
		, 946  => 5.9480676339111E+284 , 947  => 1.1896135267822E+285 , 948  => 2.3792270535645E+285
		, 949  => 4.7584541071289E+285 , 950  => 9.5169082142578E+285 , 951  => 1.9033816428516E+286
		, 952  => 3.8067632857031E+286 , 953  => 7.6135265714062E+286 , 954  => 1.5227053142812E+287
		, 955  => 3.0454106285625E+287 , 956  => 6.090821257125E+287  , 957  => 1.218164251425E+288
		, 958  => 2.43632850285E+288   , 959  => 4.8726570057E+288    , 960  => 9.7453140114E+288
		, 961  => 1.94906280228E+289   , 962  => 3.89812560456E+289   , 963  => 7.79625120912E+289
		, 964  => 1.559250241824E+290  , 965  => 3.118500483648E+290  , 966  => 6.237000967296E+290
		, 967  => 1.2474001934592E+291 , 968  => 2.4948003869184E+291 , 969  => 4.9896007738368E+291
		, 970  => 9.9792015476736E+291 , 971  => 1.9958403095347E+292 , 972  => 3.9916806190694E+292
		, 973  => 7.9833612381389E+292 , 974  => 1.5966722476278E+293 , 975  => 3.1933444952556E+293
		, 976  => 6.3866889905111E+293 , 977  => 1.2773377981022E+294 , 978  => 2.5546755962044E+294
		, 979  => 5.1093511924089E+294 , 980  => 1.0218702384818E+295 , 981  => 2.0437404769636E+295
		, 982  => 4.0874809539271E+295 , 983  => 8.1749619078542E+295 , 984  => 1.6349923815708E+296
		, 985  => 3.2699847631417E+296 , 986  => 6.5399695262834E+296 , 987  => 1.3079939052567E+297
		, 988  => 2.6159878105133E+297 , 989  => 5.2319756210267E+297 , 990  => 1.0463951242053E+298
		, 991  => 2.0927902484107E+298 , 992  => 4.1855804968214E+298 , 993  => 8.3711609936427E+298
		, 994  => 1.6742321987285E+299 , 995  => 3.3484643974571E+299 , 996  => 6.6969287949142E+299
		, 997  => 1.3393857589828E+300 , 998  => 2.6787715179657E+300 , 999  => 5.3575430359313E+300
		, 1000 => 1.0715086071863E+301 , 1001 => 2.1430172143725E+301 , 1002 => 4.2860344287451E+301
		, 1003 => 8.5720688574901E+301 , 1004 => 1.714413771498E+302  , 1005 => 3.4288275429961E+302
		, 1006 => 6.8576550859921E+302 , 1007 => 1.3715310171984E+303 , 1008 => 2.7430620343968E+303
		, 1009 => 5.4861240687937E+303 , 1010 => 1.0972248137587E+304 , 1011 => 2.1944496275175E+304
		, 1012 => 4.388899255035E+304  , 1013 => 8.7777985100699E+304 , 1014 => 1.755559702014E+305
		, 1015 => 3.511119404028E+305  , 1016 => 7.0222388080559E+305 , 1017 => 1.4044477616112E+306
		, 1018 => 2.8088955232224E+306 , 1019 => 5.6177910464447E+306 , 1020 => 1.1235582092889E+307
		, 1021 => 2.2471164185779E+307 , 1022 => 4.4942328371558E+307 , 1023 => 8.9884656743116E+307
	];

	define('std\FLT_SIZE'       , PHP_INT_SIZE);
	define('std\FLT_MAX'        , PHP_FLOAT_MAX);
	define('std\FLT_LOWEST'     , -PHP_FLOAT_MAX);
	define('std\FLT_MIN'        , PHP_FLOAT_MIN);
	define('std\FLT_RADIX'      , 2);
	define('std\FLT_ROUNDS'     , 1);
	define('std\FLT_EPSILON'    , PHP_FLOAT_EPSILON);

	if (FLT_SIZE < 8) {
		define('std\FLT_MANT_DIG'   , 24);
		define('std\FLT_DIG'        , 6);
		define('std\FLT_MIN_EXP'    , -125);
		define('std\FLT_MAX_EXP'    , 128);
		define('std\FLT_MIN_10_EXP' , -37);
		define('std\FLT_MAX_10_EXP' , 38);
	} else {
		define('std\FLT_MANT_DIG'   , 53);
		define('std\FLT_DIG'        , 15);
		define('std\FLT_MIN_EXP'    , -1021);
		define('std\FLT_MAX_EXP'    , 1024);
		define('std\FLT_MIN_10_EXP' , -307);
		define('std\FLT_MAX_10_EXP' , 308);
	}

	define('std\SINT_EPSILON' , 0);
	define('std\SINT_SIZE'    , PHP_INT_SIZE);
	define('std\SINT_MAX'     , PHP_INT_MAX);
	define('std\SINT_LOWEST'  , -PHP_INT_MAX);
	define('std\SINT_MIN'     , PHP_INT_MIN);
	define('std\SINT_DIG'     , (int)((PHP_INT_SIZE * 8) - 1));
	define('std\SINT_DIG10'   , (int)(((PHP_INT_SIZE * 8) - 1) * 0.30102999566398));

	function _F_FP_nearest_int(float $x___)
	{
		if ($x___ == 0.5) {
			if (\fmod(\ceil($x___), 2.0)) {
				$x = \ceil($x___);
			} else {
				$x = \floor($x___);
			}
		} else {
			if (!(\intval($x___) & 1)) {
				$x = \floor($x___);
			} else {
				$x = \ceil($x___);
			}
		}
		return $x;
	}

	function _F_FP_extract_sign($x___)
	{
		$x = \strval($x___);
		return ($x[0] == '-' || $x[0] == '+') ? $x[0] : '+';
	}

	function _F_FP_del_sign($x___, int &$sign___)
	{
		if (\is_numeric($x___)) {
			$sign___ = 0;
			$x = \strval($x___);
			if ($x[0] == '-') {
				$sign___ = -1;
				return \floatval($x___) * (-1);
			} else if ($x[0] == '+') {
				$sign___ = 1;
			}
			return \floatval($x___);
		}
		return \NAN;
	}

	function _F_FP_same_sign(float $x___, float $y___)
	{
		$sx = _F_FP_extract_sign($x___);
		$sy = _F_FP_extract_sign($y___);
		return ($sx === $sy);
	}

	function _F_compute_nan()
	{ return @(0.0/0.0); }

	function _F_compute_inf()
	{ return @(1.0/0.0); }

	function _F_compute_pi()
	{
		static $_S_PI_const = null;
		if (\is_null($_S_PI_const)) {
			$_S_PI_const = \atan2(+0.0, -0.0);
		}
		return $_S_PI_const;
	}
 
	function _F_compute_e()
	{
		static $_S_E_const = null;
		if (\is_null($_S_E_const)) {
			$_S_E_const = \exp(1.0);
		}
		return $_S_E_const;
	}

	function _F_get_sign($x___)
	{
		if (\is_numeric($x___)) {
			$x = \strval($x___);
			return ($x[0] == '-') ? -1 : ($x[0] == '+') ? 1 : 0;
		}
		return \NAN;
	}

	function _F_frexp(float $x___, int &$e___)
	{
		$i = 1024 / 2;
		$j = 1024 / 2;
		if ($x___ < 1.0) {
			$g = 1.0 / $x___;
			while (true) {
				$j = \intdiv(($j + 1), 2);
				if ($g < _N_pow2_tab($i)) {
					$i -= $j;
				} else if ($j == 1 && $g < _N_pow2_tab($i + 1)) {
					break;
				} else {
					$i += $j;
				}
			}
			if ($g == _N_pow2_tab($i)) {
				$i--;
			}
			$i = -($i);
		} else if ($x___ > 1.0) {
			while (true) {
				$j = \intdiv(($j + 1), 2);
				if ($x___ > _N_pow2_tab($i)) {
					$i += $j;
				} else if ($j == 1 && $x___ > _N_pow2_tab($i-1)) {
					break;
				} else {
					$i -= $j;
				}
			}
			if ($x___ == _N_pow2_tab($i)) {
				$i++;
			}
		} else {
			$i = 1;
		}
		$e___ = $i;
		$i = -($i);
		if ($i < 0) {
			$x___ /= _N_pow2_tab(-($i));
		} else if ($i < 1024) {
			$x___ *= _N_pow2_tab($i);
		} else {
			$x___ = ($x___ * _N_pow2_tab(1024 -1)) * _N_pow2_tab($i - (1024 -1));
		}
		return $x___;
	}

	function _F_ldexp(float $x___, int $n___)
	{
		if ($n___ < 0.0) {
			 $x___ /= _N_pow2_tab(-($n___));
		} else if ($n___ < 1024) {
			 $x___ *= _N_pow2_tab($n___);
		} else {
			$x___ = ($x___ * _N_pow2_tab(1024 -1)) * _N_pow2_tab($n___ - (1024 -1));
		}
		return $x___;
	}

	function _F_erf_cheung(float $x___)
	{
		$a = copysign(1.0, $x___);
		$x = \abs($x___);
		$v = (1.0 / (1.0 + 0.3275911 * $x));
		return ($a * (1.0 - (
			((((1.061405429 * $v + -1.4531520271) * $v) + 1.421413741) 
				* $v + -0.284496736) * $v + 0.254829592) * $v * \exp(-$x * $x)
		));
	}

	function _F_erf_f77(float $x___)
	{
		$v = (1 / (1 + 0.5 * \abs($x___)));
		$Τ = $v * \exp(
				- $x___ * $x___
				- 1.26551223
				+ 1.00002368 * $v
				+ 0.37409196 * $v * $v
				+ 0.09678418 * $v * $v * $v
				- 0.18628806 * $v * $v * $v * $v
				+ 0.27886807 * $v * $v * $v * $v * $v
				- 1.13520398 * $v * $v * $v * $v * $v * $v
				+ 1.48851587 * $v * $v * $v * $v * $v * $v * $v
				- 0.82215223 * $v * $v * $v * $v * $v * $v * $v * $v
				+ 0.17087277 * $v * $v * $v * $v * $v * $v * $v * $v * $v
		);
		if ($x___ >= 0) {
			return 1 - $Τ;
		}
		return $Τ - 1;
	}

	function _F_npdf(float $x___, float $mu___, float $sigma___)
	{
		return ((\exp(-1.0 * ($x___ - $mu___) * ($x___ - $mu___) /
			(2.0 * $sigma___ * $sigma___)) / ($sigma___ * 2.50662827463100024161)
		));
	}

	function _F_ncdf_1(float $x___, float $mu___, float $sigma___)
	{ return (0.5 * (1.0 + _F_erf_f77(($x___ - $mu___) / ($sigma___ * 1.41421356237309514547)))); }

	function _F_ncdf_2(float $x___, float $mu___, float $sigma___)
	{
		$a = 0;
		for ($i = 1; $i < (1000000 - 1); $i++) {
			$a += _F_npdf($x___ + $i * ($x___ + 1000) / 1000000, $mu___, $sigma___);
		}
		return ((($x___ + 1000) / 1000000) * ((_F_npdf($x___, $mu___, $sigma___)
			+ _F_npdf(-1000, $mu___, $sigma___)) / 2.0 + $a)
		);
	}

	function _F_beta(float $x___, float $y___)
	{ return (tgamma($x___) * tgamma($y___) / tgamma($x___ + $y___)); }
}

/* EOF */