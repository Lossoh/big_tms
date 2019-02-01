function checkBlankField(field){
    var userText = field.replace(/^\s+/, '').replace(/\s+$/, '');
    var quotes = new RegExp(/^\"|\"$/);
    
    if ((userText === '')) {
        return false;
    } else {
        return true;
    }
}

function cekValidasi(isi,ket,valid){
    var userText = isi.replace(/^\s+/, '').replace(/\s+$/, '');
    var quotes = new RegExp(/^\"|\"$/);     
    var pesaneror="";
    if ((userText === ''|| isi=='')) {
		pesaneror=pesaneror+""+ket+" "+valid+"  \n\r";
		var da1=pesaneror;
		var cek=1;
	    return da1;
		 
    } else {
        var ok="";
        return ok;
    }
	
}

function cekValidasiangka(isi,ket){
   	var quotes = new RegExp(/^\"|\"$/);
	 var pesaneror="";
    if ((isi=='' || isi==0 )) {
        pesaneror=pesaneror+""+ket+" harus diisi! \n\r";
        var da1=pesaneror;
        var cek=1;
        return da1;
    } else {
        var ok="";
        return ok;
    }
	
}

function cekEnter(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode == 13)
    
    return false;
    
    return true;
    
}

function cek_Dan(evt){
var charCode = (evt.which) ? evt.which : event.keyCode;
if (charCode == 38)
    return false;
    return true;
    
}
function isDatedet(date) {
    var tanggal=reformatdet(date);
    return /^(0[1-9]|1[012])[- \/\/.](0[1-9]|[12][0-9]|3[01])[- \/\/.](19|20)\d\d$/.test(tanggal);
}

function reformatdet(tanggal){
    //9/20/2013
    
    var reformattgl=tanggal.split("-");
    var tahun=reformattgl[0];//tahun
    var bulan=reformattgl[1];//bulan
    var tanggal=reformattgl[2];//tanggal
    var tg=reformattgl[2];//tanggal
    var has=tg.slice(0,2) //
    alert(has);
    
    var reformatdet=bulan+"/"+tanggal+"/"+tahun;
    return reformatdet;
}

function reformatjam(jam){
    //9/20/2013
	
    var reformattgl=jam.split("-");
  
    var tanggal=reformattgl[2];//tanggal
	
	 var reformattgl2=tanggal.split(" ");
	 var tgl=reformattgl2[0];//jam
	 
	 var jam=reformattgl2[1];//jam
	var jamar=jam.split(":");
	 var hasjam=jamar[0];//jam
	var hasmenit=jamar[1];//jam
	var hasdetik=jamar[2];//jam
	//alert(hasdetik);
	 if(hasjam < 1 || hasjam > 23){
		 return false;
	 }
	
   // var reformatjam=hasjam+":"+hasmenit+":"+hasdetik;
//	alert(reformatjam);
   // return reformatjam;
    //alert('hasil'+reformatjam);
}


function isDate(date) {
        var tanggal=reformat(date);
	return /^(0[1-9]|1[012])[- \/\/.](0[1-9]|[12][0-9]|3[01])[- \/\/.](19|20)\d\d$/.test(tanggal);
}
function cekValidasiDetail(isi,ket,no){
	   var userText = isi.replace(/^\s+/, '').replace(/\s+$/, '');
    	var quotes = new RegExp(/^\"|\"$/);
     
	 var pesaneror="";
    if ((userText === ''|| isi=='')) {
	//	alert('kos');

		pesaneror=pesaneror+""+ket+" harus diisi pada baris "+no+"! \n\r";

		var da1=pesaneror;
		var cek=1;
        //return cek;
		 return da1;
		 
    } else {
	//	alert('ada');
        var ok="";
        return ok;
    }
	
	}

function cekValidasiDetailangka(isi,ket,no){
     var quotes = new RegExp(/^\"|\"$/);
	 var pesaneror="";
    if ((isi==null || isi==0 )) {
		pesaneror=pesaneror+""+ket+" harus diisi pada baris "+no+"! \n\r";
		var da1=pesaneror;
		var cek=1;
        return da1;
		 
    } else {
        var ok="";
        return ok;
    }
	
	}


	
function myformatter(date){
			var y = date.getFullYear();
			var m = date.getMonth()+1;
			var d = date.getDate();
			return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
		}
		
function validateEmail(email) {
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!filter.test(email)) {
    return false;
    }
 }
function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode;
    
    if (charCode != 46 && charCode > 31 
        && (charCode < 48 || charCode > 57))
        
        return false;
    
    return true;
}

function isNumberOnly(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode>47&&charCode<58)
        return true;
    //alert("Nomor dan titik saja");
//	alert("Harap masukan angka dan titik saja!");
    return false;
}
function isAlfabetDotNumberSlashKeyNoSpace(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if ((charCode >64 && charCode < 91 )|| (charCode >96 && charCode < 123)||charCode==46||(charCode>47&&charCode<58)||charCode==47)
        return true;
    //alert("Alfabet, titik, garis miring & nomor saja");
alert("Harap masukan huruf, titik, garis miring dan angka saja!");
    return false;
}
//2 fungsi berikut bekerja sama dalam pengecekan format tanggal-----------------------------------------------------


function reformatx(tanggal){
    //9/20/2013
    var reformattgl=tanggal.split("/");
    var tahun=reformattgl[2];//tahun
    var bulan=reformattgl[0];//bulan
    if(parseInt(bulan)<10){
        bulan='0'+bulan;
    }
    var tanggal=reformattgl[1];//tanggal
    if(parseInt(tanggal)<10){
        tanggal='0'+tanggal;
    }
    var reformat=bulan+"/"+tanggal+"/"+tahun;
    return reformat;
    //alert(reformat);
}

function reformat(tanggal){
    var reformattgl=tanggal.split("-");
    var tahun=reformattgl[0];//tahun
    var bulan=reformattgl[1];//bulan
    var tanggal=reformattgl[2];//tanggal
    var reformat=bulan+"/"+tanggal+"/"+tahun;
    return reformat;
}
function number_format (number, decimals, dec_point, thousands_sep, mode) {
    // Formats a number with grouped thousands
    //
    // version: 906.1806
    // discuss at: http://phpjs.org/functions/number_format
    // +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +     bugfix by: Michael White (http://getsprink.com)
    // +     bugfix by: Benjamin Lupton
    // +     bugfix by: Allan Jensen (http://www.winternet.no)
    // +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // +     bugfix by: Howard Yeend
    // +    revised by: Luke Smith (http://lucassmith.name)
    // +     bugfix by: Diogo Resende
    // +     bugfix by: Rival
    // +     input by: Kheang Hok Chin (http://www.distantia.ca/)
    // +     improved by: davook
    // +     improved by: Brett Zamir (http://brett-zamir.me)
    // +     input by: Jay Klehr
    // +     improved by: Brett Zamir (http://brett-zamir.me)
    // +     input by: Amir Habibi (http://www.residence-mixte.com/)
    // +     bugfix by: Brett Zamir (http://brett-zamir.me)
    // +     improved by: Rassel Pratomo
    // *     example 1: number_format(1234.56);
    // *     returns 1: '1,235'
    // *     example 2: number_format(1234.56, 2, ',', ' ');
    // *     returns 2: '1 234,56'
    // *     example 3: number_format(1234.5678, 2, '.', '');
    // *     returns 3: '1234.57'
    // *     example 4: number_format(67, 2, ',', '.');
    // *     returns 4: '67,00'
    // *     example 5: number_format(1000);
    // *     returns 5: '1,000'
    // *     example 6: number_format(67.311, 2);
    // *     returns 6: '67.31'
    // *     example 7: number_format(1000.55, 1);
    // *     returns 7: '1,000.6'
    // *     example 8: number_format(67000, 5, ',', '.');
    // *     returns 8: '67.000,00000'
    // *     example 9: number_format(0.9, 0);
    // *     returns 9: '1'
    // *     example 10: number_format('1.20', 2);
    // *     returns 10: '1.20'
    // *     example 11: number_format('1.20', 4);
    // *     returns 11: '1.2000'
    // *     example 12: number_format('1.2000', 3);
                // *     returns 12: '1.200'
        if(mode=='format'){
        var n = number, prec = decimals;

        var toFixedFix = function (n,prec) {
            var k = Math.pow(10,prec);
            return (Math.round(n*k)/k).toString();
        };

        n = !isFinite(+n) ? 0 : +n;
        prec = !isFinite(+prec) ? 0 : Math.abs(prec);
        var sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep;
        var dec = (typeof dec_point === 'undefined') ? '.' : dec_point;

        var s = (prec > 0) ? toFixedFix(n, prec) : toFixedFix(Math.round(n), prec); //fix for IE parseFloat(0.55).toFixed(0) = 0;

        var abs = toFixedFix(Math.abs(n), prec);
        var _, i;

        if (abs >= 1000) {
            _ = abs.split(/\D/);
            i = _[0].length % 3 || 3;

            _[0] = s.slice(0,i + (n < 0)) +
                _[0].slice(i).replace(/(\d{3})/g, sep+'$1');
            s = _.join(dec);
        } else {
            s = s.replace('.', dec);
        }

        var decPos = s.indexOf(dec);
        if (prec >= 1 && decPos !== -1 && (s.length-decPos-1) < prec) {
            s += new Array(prec-(s.length-decPos-1)).join(0)+'0';
        }
        else if (prec >= 1 && decPos === -1) {
            s += dec+new Array(prec).join(0)+'0';
        }
        return s;
        }else if(mode=='deformat'){

            var deformatter = number.split(".");
            var size = deformatter.length;
            var result='';
            for(i=0;i<size;i++){
                result = result+deformatter[i];
            }
            return parseInt(result);
        }
    } 
       


function lihatTgl(bln,tanggal){
	var reformattgl=bln.split("-");
    var bulan=reformattgl[0];//tahun
    var tahun=reformattgl[1];//bulan
	var nilbul=bulanangka(bulan);
	
	
	var konvers=tanggal.split("-");
    var th=konvers[0];//tahun
    var bl=konvers[1];//bulan
	
	var bulan1=th+"-"+bl;
	var bulan2=tahun+"-"+nilbul;
	var valbln;
	if(bulan1==bulan2){
	   valbln="";
	}else{
	   valbln=" Tanggal Tidak Sesuai Periode";
	}
	return valbln;
	//alert(bulan2);
	
}



function formatPrice(val,row){
    return number_format(val,0,',','.','format');
}


function isValidDate(str){
	// STRING FORMAT yyyy-mm-dd
	if(str=="" || str==null){return false;}								
	
	// m[1] is year 'YYYY' * m[2] is month 'MM' * m[3] is day 'DD'					
	var m = str.match(/(\d{4})-(\d{2})-(\d{2})/);
	
	// STR IS NOT FIT m IS NOT OBJECT
	if( m === null || typeof m !== 'object'){return false;}				
	
	// CHECK m TYPE
	if (typeof m !== 'object' && m !== null && m.size!==3){return false;}
				
	var ret = true; //RETURN VALUE						
	var thisYear = new Date().getFullYear(); //YEAR NOW
	var minYear = 1999; //MIN YEAR
	
	// YEAR CHECK
	if( (m[1].length < 4) || m[1] < minYear || m[1] > thisYear){ret = false;}
	// MONTH CHECK			
	if( (m[1].length < 2) || m[2] < 1 || m[2] > 12){ret = false;}
	// DAY CHECK
	if( (m[1].length < 2) || m[3] < 1 || m[3] > 31){ret = false;}
	
	return ret;			
}
