// ** I18N

// Calendar IT (italian) language
// Author: Mihai Bazon, <mihai_bazon@yahoo.com>
// Encoding: any
// Distributed under the same terms as the calendar itself.

// For translators: please use UTF-8 if possible.We strongly believe that
// Unicode is the answer to a real internationalized world.Also please
// include your contact information in the header, as can be seen above.

// Translator: Paola Pluchino, <pluchino2@supereva.it>

// full day names
Calendar._DN = new Array
("Domenica",
 "Lunedì",
 "Martedì",
 "Mercoledì",
 "Giovedì",
 "Venerdì",
 "Sabato",
 "Domenica");

// Please note that the following array of short day names (and the same goes
// for short month names, _SMN) isn't absolutely necessary.We give it here
// for exemplification on how one can customize the short day names, but if
// they are simply the first N letters of the full name you can simply say:
//
// Calendar._SDN_len = N; // short day name length
// Calendar._SMN_len = N; // short month name length
//
// If N = 3 then this is not needed either since we assume a value of 3 if not
// present, to be compatible with translation files that were written before
// this feature.

// short day names
Calendar._SDN = new Array
("Dom",
 "Lun",
 "Mar",
 "Mer",
 "Gio",
 "Ven",
 "Sab",
 "Dom");

// First day of the week. "0" means display Sunday first, "1" means display
// Monday first, etc.
Calendar._FD = 0;

// full month names
Calendar._MN = new Array
("Gennaio",
 "Febbraio",
 "Marzo",
 "Aprile",
 "Maggio",
 "Giugno",
 "Luglio",
 "Agosto",
 "Settembre",
 "Ottobre",
 "Novembre",
 "Dicembre");

// short month names
Calendar._SMN = new Array
("Gen",
 "Feb",
 "Mar",
 "Apr",
 "Mag",
 "Giu",
 "Lug",
 "Ago",
 "Set",
 "Ott",
 "Nov",
 "Dic");

// tooltips
Calendar._TT = {};
Calendar._TT["INFO"] = "About the calendar";

Calendar._TT["ABOUT"] =
"DHTML Date/Time Selector\n" +
"(c) dynarch.com 2002-2005 / Author: Mihai Bazon\n" + // don't translate this this ;-)
"For latest version visit: http://www.dynarch.com/projects/calendar/\n" +
"Distributed under GNU LGPL.See http://gnu.org/licenses/lgpl.html for details." +
"\n\n" +
"Selezione Data:\n" +
"- Usa i bottoni \xab, \xbb per selezionare l'anno\n" +
"- Usa i bottoni" + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " per selezionare il mese\n" +
"- Tieni premuto il tasto del mouse su questi bottoni per una selezione rapida.";
Calendar._TT["ABOUT_TIME"] = "\n\n" +
"Selezione Ora:\n" +
"- Clicca su una parte dell'ora per aumentarla\n" +
"- o clicca tenendo premuto Maiusc per diminurla\n" +
"- o clicca e trascina per una selezione rapida.";

Calendar._TT["PREV_YEAR"] = "Anno prec. (premi per menu)";
Calendar._TT["PREV_MONTH"] = "Mese prec. (premi per menu)";
Calendar._TT["GO_TODAY"] = "Vai a Oggi";
Calendar._TT["NEXT_MONTH"] = "Mese succ. (premi per menu)";
Calendar._TT["NEXT_YEAR"] = "Anno succ. (premi per menu)";
Calendar._TT["SEL_DATE"] = "Seleziona data";
Calendar._TT["DRAG_TO_MOVE"] = "Trascina per spostare";
Calendar._TT["PART_TODAY"] = " (oggi)";

// the following is to inform that "%s" is to be the first day of week
// %s will be replaced with the day name.
Calendar._TT["DAY_FIRST"] = "Mostra %s come primo giorno della settimana";

// This may be locale-dependent.It specifies the week-end days, as an array
// of comma-separated numbers.The numbers are from 0 to 6: 0 means Sunday, 1
// means Monday, etc.
Calendar._TT["WEEKEND"] = "0,6";

Calendar._TT["CLOSE"] = "Chiudi";
Calendar._TT["TODAY"] = "Oggi";
Calendar._TT["TIME_PART"] = "(Maiusc-)Click o trascina per cambiare valore";

// date formats
Calendar._TT["DEF_DATE_FORMAT"] = "%d/%m/%Y";
Calendar._TT["TT_DATE_FORMAT"] = "%a, %e %b";

Calendar._TT["WK"] = "sett";
Calendar._TT["TIME"] = "Ora:";
