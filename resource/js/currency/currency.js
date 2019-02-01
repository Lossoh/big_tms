function angka(e) {
   if (!/^[0-9]+$/.test(e.value)) {
      e.value = e.value.substring(0,e.value.length-1);
   }
}

// Validasi Number, koma, min
function IsNumeric(object)
{
	var strValidChars = "0123456789,-";
	var strChar;
	var blnResult = true;
	var strString = object.value;
	var isComma = true;
	var isMinus = true;
 
	if (strString.length == 0) return false;
 
	for (i = 0; i < strString.length && blnResult == true; i++)
	{
		strChar = strString.charAt(i);
		 
		if (strValidChars.indexOf(strChar) == -1)
		{
			strString = strString.replace(strChar, "");
		}
		 
		if (strChar == '.' && isComma == true)
		{
			isComma = false;
		}
		else if (strChar == '.' && isComma == false)
		{
			strString = strString.substring(i, "");                                  
		}
		 
		if (strChar == '-' && isMinus == true)
		{
			isMinus = false;
		}
		else if (strChar == '-' && isMinus == false)
		{
			strString = strString.substring(i, "");                                  
		}
	}
	object.value = strString;
}

function IsNumericOnly(object)
{
	var strValidChars = "0123456789.-";
	var strChar;
	var blnResult = true;
	var strString = object.value;
	var isComma = true;
	var isMinus = true;
 
	if (strString.length == 0) return false;
 
	for (i = 0; i < strString.length && blnResult == true; i++)
	{
		strChar = strString.charAt(i);
		 
		if (strValidChars.indexOf(strChar) == -1)
		{
			strString = strString.replace(strChar, "");
		}
		 
		if (strChar == '.' && isComma == true)
		{
			isComma = false;
		}
		else if (strChar == '.' && isComma == false)
		{
			strString = strString.substring(i, "");                                  
		}
		 
		if (strChar == '-' && isMinus == true)
		{
			isMinus = false;
		}
		else if (strChar == '-' && isMinus == false)
		{
			strString = strString.substring(i, "");                                  
		}
	}
	object.value = strString;
}

function integerNumber(object)
{
	var strValidChars = "0123456789-";
	var strChar;
	var blnResult = true;
	var strString = object.value;
	var isComma = true;
	var isMinus = true;
 
	if (strString.length == 0) return false;
 
	for (i = 0; i < strString.length && blnResult == true; i++)
	{
		strChar = strString.charAt(i);
		 
		if (strValidChars.indexOf(strChar) == -1)
		{
			strString = strString.replace(strChar, "");
		}
		 
		if (strChar == '.' && isComma == true)
		{
			isComma = false;
		}
		else if (strChar == '.' && isComma == false)
		{
			strString = strString.substring(i, "");                                  
		}
		 
		if (strChar == '-' && isMinus == true)
		{
			isMinus = false;
		}
		else if (strChar == '-' && isMinus == false)
		{
			strString = strString.substring(i, "");                                  
		}
	}
	object.value = strString;
}

function formatCurr(ini) {
    if (ini.value != "") {
        var number = bersihPemisah(ini.value);
        ini.value = CurrencyFormat(number);
    } else {
        ini.value = 0;
    }
}

function tandaPemisahTitik(b) {
    var _minus = false;
    if (b < 0)
        _minus = true;
    b = b.toString();
    b = b.replace(".", "");
    b = b.replace("-", "");
    c = "";
    panjang = b.length;
    j = 0;
    for (i = panjang; i > 0; i--) {
        j = j + 1;
        if (((j % 3) == 1) && (j != 1)) {
            c = b.substr(i - 1, 1) + "." + c;
        } else {
            c = b.substr(i - 1, 1) + c;
        }
    }
    if (_minus)
        c = "-" + c;
    return c;
}

function numbersonly(ini, e) {
    if (e.keyCode == 48 || e.keyCode >= 49) {
        if (e.keyCode <= 57) {
            a = ini.value.toString().replace(".", "");
            b = a.replace(/[^\d]/g, "");
            b = (b == "0") ? String.fromCharCode(e.keyCode) : b + String.fromCharCode(e.keyCode);
            ini.value = tandaPemisahTitik(b);
            return false;
        }
        else if (e.keyCode <= 105) {
            if (e.keyCode >= 96) {
                //e.keycode = e.keycode - 47;
                a = ini.value.toString().replace(".", "");
                b = a.replace(/[^\d]/g, "");
                b = (b == "0") ? String.fromCharCode(e.keyCode - 48) : b + String.fromCharCode(e.keyCode - 48);
                ini.value = tandaPemisahTitik(b);
                //alert(e.keycode);
                return false;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    } else if (e.keyCode == 48) {
        a = ini.value.replace(".", "") + String.fromCharCode(e.keyCode);
        b = a.replace(/[^\d]/g, "");
        if (parseFloat(b) != 0) {
            ini.value = tandaPemisahTitik(b);
            return false;
        } else {
            return false;
        }
    } else if (e.keyCode == 95) {
        a = ini.value.replace(".", "") + String.fromCharCode(e.keyCode - 48);
        b = a.replace(/[^\d]/g, "");
        if (parseFloat(b) != 0) {
            ini.value = tandaPemisahTitik(b);
            return false;
        } else {
            return false;
        }
    } else if (e.keyCode == 8 || e.keycode == 46) {
        a = ini.value.replace(".", "");
        b = a.replace(/[^\d]/g, "");
        b = b.substr(0, b.length - 1);
        if (tandaPemisahTitik(b) != "") {
            ini.value = tandaPemisahTitik(b);
        } else {
            ini.value = "";
        }

        return false;
    } else if (e.keyCode == 9) {
        return true;
    } else if (e.keyCode == 17) {
        return true;
    } else {
        //alert (e.keyCode);
        return false;
    }
}

function decimalValue(event) {
    var charCode = (event.which) ? event.which : event.keyCode;
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function CurrencyFormat(number) {
    var decimalplaces = 0;
    var decimalcharacter = ",";
    var thousandseparater = ".";
    number = parseFloat(number);
    var sign = number < 0 ? "-" : "";
    var formatted = new String(number.toFixed(decimalplaces));
    if (decimalcharacter.length && decimalcharacter != ".") {
        formatted = formatted.replace(/\./, decimalcharacter);
    }
    var integer = "";
    var fraction = "";
    var strnumber = new String(formatted);
    var dotpos = decimalcharacter.length ? strnumber.indexOf(decimalcharacter) : -1;
    if (dotpos > -1)
    {
        if (dotpos) {
            integer = strnumber.substr(0, dotpos);
        }
        fraction = strnumber.substr(dotpos + 1);
    }
    else {
        integer = strnumber;
    }
    if (integer) {
        integer = String(Math.abs(integer));
    }
    while (fraction.length < decimalplaces) {
        fraction += "0";
    }
    temparray = new Array();
    while (integer.length > 3)
    {
        temparray.unshift(integer.substr(-3));
        integer = integer.substr(0, integer.length - 3);
    }
    temparray.unshift(integer);
    integer = temparray.join(thousandseparater);
    return sign + integer;
}

function bersihPemisah(ini) {
    a = ini.toString().replace(/\./g, "");
    //a = a.replace(".","");
    return a;
}

function terbilang(bilangan) {
    bilangan = String(bilangan);
    var angka = new Array('0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
    var kata = new Array('', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan');
    var tingkat = new Array('', 'Ribu', 'Juta', 'Milyar', 'Triliun');

    var panjang_bilangan = bilangan.length;

    /* pengujian panjang bilangan */
    if (panjang_bilangan > 15) {
        kaLimat = "Diluar Batas";
        return kaLimat;
    }

    /* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
    for (i = 1; i <= panjang_bilangan; i++) {
        angka[i] = bilangan.substr(-(i), 1);
    }

    i = 1;
    j = 0;
    kaLimat = "";


    /* mulai proses iterasi terhadap array angka */
    while (i <= panjang_bilangan) {

        subkaLimat = "";
        kata1 = "";
        kata2 = "";
        kata3 = "";

        /* untuk Ratusan */
        if (angka[i + 2] != "0") {
            if (angka[i + 2] == "1") {
                kata1 = "Seratus";
            } else {
                kata1 = kata[angka[i + 2]] + " Ratus";
            }
        }

        /* untuk Puluhan atau Belasan */
        if (angka[i + 1] != "0") {
            if (angka[i + 1] == "1") {
                if (angka[i] == "0") {
                    kata2 = "Sepuluh";
                } else if (angka[i] == "1") {
                    kata2 = "Sebelas";
                } else {
                    kata2 = kata[angka[i]] + " Belas";
                }
            } else {
                kata2 = kata[angka[i + 1]] + " Puluh";
            }
        }

        /* untuk Satuan */
        if (angka[i] != "0") {
            if (angka[i + 1] != "1") {
                kata3 = kata[angka[i]];
            }
        }

        /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
        if ((angka[i] != "0") || (angka[i + 1] != "0") || (angka[i + 2] != "0")) {
            subkaLimat = kata1 + " " + kata2 + " " + kata3 + " " + tingkat[j] + " ";
        }

        /* gabungkan variabe sub kaLimat (untuk Satu blok 3 angka) ke variabel kaLimat */
        kaLimat = subkaLimat + kaLimat;
        i = i + 3;
        j = j + 1;

    }

    /* mengganti Satu Ribu jadi Seribu jika diperlukan */
    if ((angka[5] == "0") && (angka[6] == "0")) {
        kaLimat = kaLimat.replace("Satu Ribu", "Seribu");
    }

    return kaLimat;
}