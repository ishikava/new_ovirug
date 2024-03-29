#!/bin/sh
cd `dirname $0`
./cpverify cprocsp-compat-debian_1.0.0-1_all.deb 15C5E9F9B055058F97A83316E2985E5A1557B2AA8A9B349FA46CFC9256C50213
test $? -eq 0 || exit 1
./cpverify cprocsp-cpopenssl-110-64_5.0.11455-5_amd64.deb 61A863424041504FD5041B8D61CAC9AC0E3228BB3D5A190722423BF146ED532C
test $? -eq 0 || exit 1
./cpverify cprocsp-cpopenssl-110-base_5.0.11455-5_all.deb 914F40B1D4A8F70964180D558FD7CAB8888B14C1DC2F82EF7695CC6717325A05
test $? -eq 0 || exit 1
./cpverify cprocsp-cpopenssl-110-devel_5.0.11455-5_all.deb AC3595DE7B2CC50ED2C15C410468DF55D8CC3E4429242E831F6D04A6C23BC75E
test $? -eq 0 || exit 1
./cpverify cprocsp-cpopenssl-110-gost-64_5.0.11455-5_amd64.deb ECA964F97FF82EFE55C06DFE39D76F6130C0B5B092E40ECF910CCCCB02DF0A1B
test $? -eq 0 || exit 1
./cpverify cprocsp-cpopenssl-64_5.0.11455-5_amd64.deb 15A5261C914E71D94870C126DB1A3E2C63BC10C2674537196072BE3BD7242F4B
test $? -eq 0 || exit 1
./cpverify cprocsp-cpopenssl-base_5.0.11455-5_all.deb 3946DFD8D1BF3F2DDC46708AE741980D922B5255F92841D32120F7FCF2B11D78
test $? -eq 0 || exit 1
./cpverify cprocsp-cpopenssl-devel_5.0.11455-5_all.deb 45679FC7592AE95FA51518F2D78C23FB3883EA42B6A788600B10172BF57D090E
test $? -eq 0 || exit 1
./cpverify cprocsp-cpopenssl-gost-64_5.0.11455-5_amd64.deb 35F60CFAEB2C3EDE07B6F9D7B084ECA63A92712826AC4CC9E23B110C80730BBD
test $? -eq 0 || exit 1
./cpverify cprocsp-cptools-gtk-64_5.0.11455-5_amd64.deb A381C0FB062AD0B50BB1A954F2A4727C9AD0964D350DF1A5950702ED713D4A6B
test $? -eq 0 || exit 1
./cpverify cprocsp-curl-64_5.0.11455-5_amd64.deb 44A9C56522EBFE8CAA92A4D074A72E802739844B5F888EEDF510A34DB011C78D
test $? -eq 0 || exit 1
./cpverify cprocsp-rdr-cloud-64_5.0.11455-5_amd64.deb 3E760074971BCA43419AAB8E13E3B4AFA9D8846AF5E52FC240DAD0E4F9223C00
test $? -eq 0 || exit 1
./cpverify cprocsp-rdr-cloud-gtk-64_5.0.11455-5_amd64.deb 731329CC18FE3DFC14EFAC6D454465BCF3F73951CCE03BBA53E66060F8071D54
test $? -eq 0 || exit 1
./cpverify cprocsp-rdr-cpfkc-64_5.0.11455-5_amd64.deb 34E8A15C8BFD4AB5F5C02CAF6594335C3E29A2E6225226F7E7EB622A0B706EE5
test $? -eq 0 || exit 1
./cpverify cprocsp-rdr-emv-64_5.0.11455-5_amd64.deb A38DC49943C5E12B16CB38A658CA2AFB4D59AD226E1F439C89B1DF426323E770
test $? -eq 0 || exit 1
./cpverify cprocsp-rdr-esmart-64_5.0.11455-5_amd64.deb 709C00607C5CDD878CD273A248C8C66D88AFFDCA5F2331D147EF85B6FF4CE23E
test $? -eq 0 || exit 1
./cpverify cprocsp-rdr-gui-gtk-64_5.0.11455-5_amd64.deb 566B3006162DD9235D8A8B6AB3A0EC7E3677E3F126E816297C58F18F5440CBA8
test $? -eq 0 || exit 1
./cpverify cprocsp-rdr-infocrypt-64_5.0.11455-5_amd64.deb 741AA3CE38DB2868E9567EDE0CE88A77F508190436805A3C80360293F0E0A5EF
test $? -eq 0 || exit 1
./cpverify cprocsp-rdr-inpaspot-64_5.0.11455-5_amd64.deb 1C0C1975648A93262DD9E79389ABBF72D554BD6098AFE8A621C5C293156F931E
test $? -eq 0 || exit 1
./cpverify cprocsp-rdr-jacarta-64_5.0.0.1148-4_amd64.deb 6FD468DD4A915F468752565911ABD60DB9032B334C4719E4EE8DF46961B2C5C5
test $? -eq 0 || exit 1
./cpverify cprocsp-rdr-kst-64_5.0.11455-5_amd64.deb F4E36C01EC9295619BBAC751ACA884BEAEC3A2CAAEA36B09A7D12EBCE90EF3EF
test $? -eq 0 || exit 1
./cpverify cprocsp-rdr-mskey-64_5.0.11455-5_amd64.deb D51FB17E90A1CAEC8B705BF490568F7039872EE02F202E8E837B45840FA2B0A2
test $? -eq 0 || exit 1
./cpverify cprocsp-rdr-novacard-64_5.0.11455-5_amd64.deb 31B23E365CB5EF46310FC30DB5AB2372FE8A69F88D976D20D514DA2E8364888F
test $? -eq 0 || exit 1
./cpverify cprocsp-rdr-pcsc-64_5.0.11455-5_amd64.deb BFD323137BAA661C058C54D2C470C7CA63790291924D2E1D661A76BCCB341A31
test $? -eq 0 || exit 1
./cpverify cprocsp-rdr-rosan-64_5.0.11455-5_amd64.deb 202BAD814D935544AA276DAB481D3C682A8697230DBF6B11BA1FC44C3CC17B0C
test $? -eq 0 || exit 1
./cpverify cprocsp-rdr-rutoken-64_5.0.11455-5_amd64.deb B37DF1B51506C25F738769F336FE89B00B8AD4E9DDEFD262F1046A62D4564FEF
test $? -eq 0 || exit 1
./cpverify cprocsp-rsa-64_5.0.11455-5_amd64.deb D033C041C5D2C83E184CB93F43D7F73B1C99032B928CD3AB1DAC3844BDCE0B53
test $? -eq 0 || exit 1
./cpverify cprocsp-stunnel-64_5.0.11455-5_amd64.deb 64299D65E38C0BD9295F0495EB1A5704E3D098D34717AD5A2C4C096BB1FA3BB8
test $? -eq 0 || exit 1
./cpverify cprocsp-xer2print_5.0.11455-5_all.deb 627905D01877EA4A72D48C1E7B91D3EB68ABAD8778B083A663E0B2D3C0E43581
test $? -eq 0 || exit 1
./cpverify cpverify 69A564FC11398D275A4E770144BCB7BFBAE1DE11D746195EBFF5CFEF82179830
test $? -eq 0 || exit 1
./cpverify ifd-rutokens_1.0.1_amd64.deb F332EE350CDA6850CE0DF707F1F8403D3F9B8577F14CBF14AAC3C75D0DF1A0E3
test $? -eq 0 || exit 1
./cpverify install.desktop FD75AF938C1FECFFF792171D42849403B5D7C0C2A851CAF933DB21139F5EBAC5
test $? -eq 0 || exit 1
./cpverify install_gui.sh 6DB007BBB71AA3BB46109BD03D93DC103C9227F09B296C92FFF6B3BDF3C7B1A6
test $? -eq 0 || exit 1
./cpverify install.sh 4A719B7E94037AF6667A9E9906994B8B9652D40A1F9627D2A2433C9D8BE2B2EF
test $? -eq 0 || exit 1
./cpverify linux-amd64.ini E4B849000BA2FB4DA4F351998FE04E4C5FDFA7F0F13AA8C0309B1F699E8B14E3
test $? -eq 0 || exit 1
./cpverify lsb-cprocsp-base_5.0.11455-5_all.deb E9097C9E890CEB598F89DCC2B743865A6BF2DBCCB40D36F66786F70E96D320AD
test $? -eq 0 || exit 1
./cpverify lsb-cprocsp-ca-certs_5.0.11455-5_all.deb C2FA284391824296FC85DB81C714DE4E9390CF02B6A31190D6EA849796F2C11D
test $? -eq 0 || exit 1
./cpverify lsb-cprocsp-capilite-64_5.0.11455-5_amd64.deb D78CFA2EBCDB525656AC7D4BBEC644660C9F5CB369F2E0BC0B6FBD33D461D8A1
test $? -eq 0 || exit 1
./cpverify lsb-cprocsp-devel_5.0.11455-5_all.deb 703DABDA53D0069ACDBD68893510837FFD9BF1CA5BA24E661E41AD4ADA6A7A05
test $? -eq 0 || exit 1
./cpverify lsb-cprocsp-kc1-64_5.0.11455-5_amd64.deb B17971F8EB8CC45092D7FC405C70703A4539DA703FE9A8B4ADC4AA396A941311
test $? -eq 0 || exit 1
./cpverify lsb-cprocsp-kc2-64_5.0.11455-5_amd64.deb 58059F45785CC6393D8A0DD7926A443529D08CBACBD0DA66D05DCDF23D3C7A50
test $? -eq 0 || exit 1
./cpverify lsb-cprocsp-pkcs11-64_5.0.11455-5_amd64.deb 7F25312998CDABDC078866CBDF0A2D8E028FAA8AE9D600591DEACD40F89FAAB0
test $? -eq 0 || exit 1
./cpverify lsb-cprocsp-rdr-64_5.0.11455-5_amd64.deb D903CE23CA97542EB0C830D83DF98A6146B6BE1A17074E67DDF6AE8517AEE528
test $? -eq 0 || exit 1
./cpverify lsb-cprocsp-rdr-accord-64_5.0.11455-5_amd64.deb 96C241F3C9C46052A0A5AFB3827A4B709A9E801C0CC11F5B7B8A58475C0C635F
test $? -eq 0 || exit 1
./cpverify lsb-cprocsp-rdr-ancud-64_5.0.11455-5_amd64.deb B113F994488573A90CFEA5AE99EE84BB5C57B7D0DD80112519F5B57AC4D5A49F
test $? -eq 0 || exit 1
./cpverify lsb-cprocsp-rdr-crypton-64_5.0.11455-5_amd64.deb 930CEFF4533B6E3B18C97118FF48FC5B17E67D23A7B592E43507E98515DBCAF8
test $? -eq 0 || exit 1
./cpverify lsb-cprocsp-rdr-maxim-64_5.0.11455-5_amd64.deb 8D984C2C7F199D6959261CF4D961F4D6666743941784DDA9BFF776B935B9EF47
test $? -eq 0 || exit 1
./cpverify lsb-cprocsp-rdr-sobol-64_5.0.11455-5_amd64.deb E1DE25279C6B2FB2A6E9325424BEE84D9859593C7FBAFF3A3560AEF73AACDE7F
test $? -eq 0 || exit 1
./cpverify uninstall.sh 253AB164F0C73B70700F1B767C8356EE414C547EEA965367A02AF35DE7890FFF
test $? -eq 0 || exit 1
printf "Everything is OK.\n"
