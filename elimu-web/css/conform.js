

   /*==================================================================================|
        |                                                                                                                                                                                                                                |
        |   _______   ___                      ____                                         |
   |        ConForm : CONtrole des champs d'un FORMulaire                                                                                      |
        |   ¯¯¯¯¯¯¯   ¯¯¯                      ¯¯¯¯                                         |
        |                                                                                                                                                                                                                                |
        |                                                            ~\\|//                                                                                                                                                |
   |                        (@ ~)                                                                                                                                                |
   |     •———————————oOOO————(_)————OOOo—————————•                                                                                                        |
   |     | M'écrire : http://mas.keo.in?Code=Bul |                                                                                                        |
   |     | Mon Site : http://bul.fr.nf           |                                                                                                        |
   |     |              .oooO   Oooo.            |                                                                                                        |
   |     •——————————————(   )———(   )————————————•                                                                                                        |
   |                     \ (     ) /                                                                                                                                        |
   |                      \_)   (_/                                                                                                                                                |
        |                                                                                                                                                                                                                                |
        |===================================================================================|
        |                                                                                                                        |                                                                                                        |
        |             lang="                                                                                        |                                                                                                        |
        |————————————————————————————————————————————|——————————————————————————————————————|
        |                          nom:nom de la zone;                                        | par défaut : n° champ                                         |
        |————————————————————————————————————————————|——————————————————————————————————————|
        |                          erreur:libellé de l'erreur;                        | par défaut : invalide                                         |
        |————————————————————————————————————————————|——————————————————————————————————————|
        |             type:obligatoire;                                        | doit être renseigné                                                |
        |                                   date;                                                                        | dépend de "format:"                                                |
        |                                   cocher;                                                                | cases à cocher (checkbox)                                |
        |                                   liste;                                                                | select où choisir des lignes                        |
        |                                   radio;                                                                | radio à cocher ( au moins 1 )                        |
        |                                   mail;                                                                        | adresse Mail ( ab.cd@ef.gh )                        |
        |                                   nombre;                                                                | valeur                                                                                        |
        |                                   specifique;                                                        | test à faire (dans format:)                                |
        |                                   accepter                                                                | 1 checkbox/radio qui doit être coché        |
        |————————————————————————————————————————————|——————————————————————————————————————|
        |             format:de la date;                                        | si type:date  aaaammjj                                        |
        |                                                                                                                        |               aaaa-mm-jj ( défaut )         |
        |                                         test particulier;                                | if ( test particulier )                                        |
        |————————————————————————————————————————————|——————————————————————————————————————|
        |                          separateur:?;                                                        | entre jj,mm et aaaa                                                |
        |                                                                                                                        | par défaut : n'importe                                   |
        |————————————————————————————————————————————|——————————————————————————————————————|
        |                          mini:valeur;                                                                | ° valeur mini de nombre                               |
        |                                                                                                                        | ° nombre de cases mini à cocher           |
        |                                                                                                                        |  si select multiple, par défaut=1                |
        |                                                   | ° nbr caractères mini à saisir       |
        |                                                   |    si type:obligatoire               |
        |                                                   |    1 par défaut                      |
        |————————————————————————————————————————————|——————————————————————————————————————|
        |                          maxi:valeur;                                                                | ° valeur maxi de nombre                                        |
        |                                                                                                                        | ° nbr cases maxi à cocher si                         |
        |                                                                                                                        |   select multiple, par défaut=mini        |
        |                                                   | ° nbr caractères maxi à saisir       |
        |                                                   |    si type:obligatoire               |
        |                                                   |    pas de maxi par défaut            |
        |————————————————————————————————————————————|——————————————————————————————————————|
        |                          bonfond:couleur;                                                | couleur fond si contrôles bons                        |
        |————————————————————————————————————————————|——————————————————————————————————————|
        |                          bontexte:couleur;                                                | couleur texte si contrôles bons                |
        |————————————————————————————————————————————|——————————————————————————————————————|
        |                          erreurfond:couleur;                                        | couleur fond si contrôles faux                 |
        |————————————————————————————————————————————|——————————————————————————————————————|
        |                          erreurtexte:couleur;                                        | couleur texte si contrôles faux                |
        |————————————————————————————————————————————|——————————————————————————————————————|
        |                  "                                                                                        |                                                                                                        |
        |                                                                                                                        |                                                                                                        |
        |===================================================================================|
        |                                                                                                                                                                                                                                |
        |                         Si vous ajoutez/modifier des contrôles, ce serait                                                                    |
        |                        sympa de me les faire parvenir  : merci d'avance.                                                                         |
        |                        Si vous voulez que j'en ajoute  : contactez-moi.                                                                        |
        |                                                                                                                                                                                                                                |
        |==================================================================================*/

//######################################################################
function RLtrim(zone)        //## supprimer les espaces en début et en fin ##
//######################################################################
{
        return zone.replace(/(^\s*)|(\s*$)/g,"");
}
//###########################################################
function SignalErreur(z1,frm,z2)        //## signaler les erreurs ##
//###########################################################
{
		frm.elements[z2].focus();
        if ( z1["erreurfond"] )
        {
                frm.elements[z2].style.backgroundColor=z1["erreurfond"] ;
        }
        if ( z1["erreurtexte"] )
        {
                frm.elements[z2].style.color=z1["erreurtexte"] ;
        }
        return "\r\n"+z1["erreur"];
}
//#####################################################################
function conform(formulaire)        //## contrôle des champs du formulaire ##
//#####################################################################
{
  var retour="",tester;
  for (  no_element=0; no_element<formulaire.elements.length;no_element++)        // pour toutes les champs d'un formulaire
  {
          tester=formulaire.elements[no_element].controle;        //#### non traité par moteurs Gecko
  //        tester=formulaire.elements[no_element].alt;                        //#### non valable pour textarea
          tester=formulaire.elements[no_element].lang;                        //        version actuelle
          if (tester)
          {        //~~~~~~~~ il y a un alt="contrôle à faire" ~~~~~~~~
                  var zones=RLtrim(tester).split(";");
                  // format : alt="id1:valeur1;id2:valeur2...."
                  var        valeur=new Array();
                  for (  var z=0; z<zones.length;   z++ )
                      // pour toutes les zones du controle
                  {        // valeur["id#"]=valeur#
                          trv=RLtrim(zones[z]).split(":");        // id#:valeur#
                          if (trv.length==2)
                          {
                                  valeur[RLtrim(trv[0].toLowerCase())]=RLtrim(trv[1].toLowerCase());
                          }
                  }
                  if ( !valeur["nom"] )
                  {
                          valeur["nom"]="Champ("+(no_element+1)+")";
                           // valeurs par défaut
                  }
                  if ( !valeur["erreur"] )
                  {
                          valeur["erreur"]=valeur["nom"]+" invalide";
                          // valeurs par défaut
                  }
                  if ( valeur["bonfond"] )
                  {
                          formulaire.elements[no_element].style.backgroundColor=valeur["bonfond"] ;
                  }
                  if ( valeur["bontexte"] )
                  {
                          formulaire.elements[no_element].style.color=valeur["bontexte"] ;
                  }
                  switch ( valeur["type"] )
                  {
                           //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ une
                                case "snombre":        //~~ nombre ~~~~~~~~~~~~~~~~~~~~~ valeur
                                //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ >= mini et <= maxi
                                 if (   formulaire.elements[no_element].value.length<1 )
                                  {
                                          retour =SignalErreur(valeur,formulaire,no_element);

                                          alert ("Le champ "+formulaire.elements[no_element].id+" est Obligatoire ");
                                          return false;
                                           break;
                                  }
                                        if (isNaN(formulaire.elements[no_element].value))
                                        {
                                                retour=SignalErreur(valeur,formulaire,no_element);

                                               alert ("Le champ "+formulaire.elements[no_element].id+" doit être un nombre ");
                                          		return false;
                                                break;
                                        }
                                        if( formulaire.elements[no_element].value.length !=valeur["maxi"])
                                  {
                                     if( formulaire.elements[no_element].value.length !=valeur["maxi"])
                                  {
                                          retour =SignalErreur(valeur,formulaire,no_element);
                                          alert(formulaire.elements[no_element].id+ " doit avoir "+valeur["maxi"]+ " Chiffres");
                                          return false;
                                          break;
                                       }
                                  }

                                    break;
                           //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ une
                                case "inombre":        //~~ nombre ~~~~~~~~~~~~~~~~~~~~~ valeur
                                //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ >= mini et <= maxi
                                 if (   formulaire.elements[no_element].value.length<1 )
                                  {
                                          retour =SignalErreur(valeur,formulaire,no_element);

                                          alert ("Le champ "+formulaire.elements[no_element].id+" est Obligatoire ");
                                          return false;
                                           break;
                                  }
                                        if (isNaN(formulaire.elements[no_element].value))
                                        {
                                                retour=SignalErreur(valeur,formulaire,no_element);

                                               alert ("Le champ "+formulaire.elements[no_element].id+" doit être un nombre ");
                                          		return false;
                                                break;
                                        }

                                    break;
                          //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ champ non vide
                          case "obligatoire1":        //~~ obligatoire ~~~~~~~~~~~~~~~~~~~ et/ou longueur
                          //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ saisie contrôlée
                                  if(formulaire.elements[no_element].value.length !=valeur["maxi"])
                                  {
                                          retour =SignalErreur(valeur,formulaire,no_element);
                                          alert("Le champ "+formulaire.elements[no_element].id+" doit avoir "+valeur["maxi"]+ " chiffres");
                                          return false;
                                          break;

                                  }
                                  else if( formulaire.elements[no_element].value.substr(0,3)!=120){
                                                if ((formulaire.elements[no_element].value.substr(0,3))!=125 ) {
                                                    alert (formulaire.elements[no_element].id+" doit  commencer par 120 ou 125");
                                                    return false;
													break;
                                                 }
                                                 else {

                                                 }

                                   }
                                  else if( formulaire.elements[no_element].value.substr(0,3)!=125){
                                                if (formulaire.elements[no_element].value.substr(0,3)!=120) {
                                                    alert (formulaire.elements[no_element].id+" doit  commencer par 120 ou 125");
                                                    return false;
													break;
                                                }
                                                else {

                                                }

                                   }

                                  break;
                          //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                          case "obligatoire_sc1":        //~~ obligatoire ~~~~~~~~~~~~~~~~~~~ et/ou longueur
                          //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ saisie contrôlée
                                 //  alert("Dieuredieuf Mame Saliou");
                                  if(formulaire.elements[no_element].value.length !=valeur["maxi"])
                                  {
                                          retour =SignalErreur(valeur,formulaire,no_element);
                                          alert(formulaire.elements[no_element].id+ " doit avoir "+valeur["maxi"]+ " Chiffres");
                                          return false;
                                          break;

                                  }

                                  break;
                           case "obligatoire_sc1a":        //~~ obligatoire ~~~~~~~~~~~~~~~~~~~ et/ou longueur
                          //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ saisie contrôlée
                                 //  alert("Dieuredieuf Mame Saliou");
                                  if(formulaire.elements[no_element].value.length !=valeur["maxi"] & isNaN(formulaire.elements[no_element].value))
                                  {
                                          retour =SignalErreur(valeur,formulaire,no_element);
                                          alert(formulaire.elements[no_element].id+ " doit avoir "+valeur["maxi"]+ " Chiffres");
                                          return false;
                                          break;

                                  }

                                  break;
                         case "obligatoire2":        //~~ obligatoire ~~~~~~~~~~~~~~~~~~~ et/ou longueur
                          //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ saisie contrôlée
						  if (   formulaire.elements[no_element].value.length<1 )
                                  {
                                          retour =SignalErreur(valeur,formulaire,no_element);
                                          //alert ( retour );
                                          alert ("Le champ "+formulaire.elements[no_element].id+" est Obligatoire ");
                                          return false;
                                           break;
                                  }
                                        if (isNaN(formulaire.elements[no_element].value))
                                        {
                                                retour=SignalErreur(valeur,formulaire,no_element);
                                               // alert ( retour );
                                               alert ("Le champ "+formulaire.elements[no_element].id+" doit être un nombre ");
                                          		return false;
                                                break;
                                        }
                                  if(formulaire.elements[no_element].value > 20)
                                  {
                                          retour =SignalErreur(valeur,formulaire,no_element);
                                         // alert("Le champ "+formulaire.elements[no_element].id+" doit avoir "+valeur["maxi"]+ " chiffres");
                                          alert("La Valeur "+formulaire.elements[no_element].id+" doit être inférieur à 20 ");
                                          return false;
                                          break;

                                  }
                                  

                                  break;
                         case "obligatoire":        //~~ obligatoire ~~~~~~~~~~~~~~~~~~~ et/ou longueur
                          //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ saisie contrôlée


                                  if (   formulaire.elements[no_element].value.length<1
                                          || ( valeur["mini"] && formulaire.elements[no_element].value.length<Number(valeur["mini"]) )
                                          || ( valeur["maxi"] && formulaire.elements[no_element].value.length>Number(valeur["maxi"]) ) )
                                  {
                                        retour=SignalErreur(valeur,formulaire,no_element);
                                           //alert ( retour );
                                           alert ("Le champ "+formulaire.elements[no_element].id+" est Obligatoire ");
                                           return false;
                                           break;

                                  }

                           break;
                          //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ différents format
                          case "date":        //~~ date ~~~~~~~~~~~~~~~~~~~~~ possible d'une date
                          //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ "adaptable facilement"
                                  var j,m,a,la,s;
                                  switch ( valeur["format"] )
                                  {
                                          case "aaaammjj":
                                                  la=4;
                                                  a=0;
                                                  m=4;
                                                  j=6;
                                                  s=new Array();
                                                  break;
                                          default:
                                                  //~~ jj/mm/aaaa par défaut
                                          case "aaaa-mm-jj":
                                                  la=4;
                                                  a=0;
                                                  m=5;
                                                  j=8;
                                                  s=new Array(4,7);
                                                  break;
                                  }
                                  if ( formulaire.elements[no_element].value.length  != (la+s.length+4) )
                                  {
                                          retour=SignalErreur(valeur,formulaire,no_element);
                                           //alert ( retour );
                                           alert ("format"+formulaire.elements[no_element].id+" est Incorrecte");
                                           return false;
                                          break;
                                  }
                                  if ( valeur["separateur"] )
                                  {
                                          for ( var n=0; n<s.length; n++ )
                                          {
                                                  if (formulaire.elements[no_element].value.charAt(s[n])!=valeur["separateur"] )
                                                  {
//sep=valeur["separateur"];                                                       
													   retour=SignalErreur(valeur,formulaire,no_element);
                                                           //alert ( retour );
                                                           alert (sep+"separateur"+formulaire.elements[no_element].id+" est  Incorrecte ");
                                                           return false;
                                                          break;
                                                  }
                                          }
                                  }
								  a=Number(formulaire.elements[no_element].value.substring(a,la));
								  m=Number(formulaire.elements[no_element].value.substring(m,m+2));
                                  j=Number(formulaire.elements[no_element].value.substring(j,j+2));
                                                                  
                                  if ( isNaN(j) || isNaN(m) || isNaN(a) || j<1 ||  m<1 || m>12 )
                                  {
                                          retour=SignalErreur(valeur,formulaire,no_element);
                                           //alert ( retour );
                                           alert (j+"contenu "+formulaire.elements[no_element].id+"est Incorrecte ");
                                           return false;
                                          break;
                                  }
                                  var fm;
                                  switch (m)
                                  {
                                          case 4:
                                          case 6:
                                          case 9:
                                          case 11:
                                                  fm=30;
                                                  break;
                                          case 2:
                                                  if ( (a%4)==0 && ((a%100)!=0 || (a%400)==0) )
                                                                  {
                                                                          fm=29;
                                                                  }
                                                  else        {
                                                                          fm=28;
                                                                  }
                                                  break;
                                          default:
                                                  fm=31;
                                                  break;
                                  }
                                  if ( j>fm )
                                  {
                                          retour=SignalErreur(valeur,formulaire,no_element);
                                           //alert ( retour );
                                           alert (formulaire.elements[no_element].id+"  Incorrecte ");
                                           return false;
                                          break;
                                  }
                                  break;
                           //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ n checkbox doivent
                                case "cocher":        //~~ checkbox ~~~~~~~~~~~~~~~~~~~~~   être cochés
                                //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ >= mini et <= maxi
                                        var nom=formulaire.elements[no_element].name;
                                        var nbc=0;
                                        for ( var n=0;n<formulaire[nom].length;n++ )
                                        {
                                                if ( formulaire[nom][n].checked )
                                                {
                                                        nbc++;
                                                }
                                        }
                                        if ( nbc<1 )
                                        {
                                                retour=SignalErreur(valeur,formulaire,no_element);
                                                //alert ( retour );
                                                alert (formulaire.elements[no_element].id+" est Obligatoire "+retour);
                                                return false;
                                                break;
                                        }
                                        break;
                                //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ format ( minimaliste )
                                case "mail":        //~~ mail ~~~~~~~~~~~~~~~~~~~~~ du
                                //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ mail
                                        if ( !formulaire.elements[no_element].value.match
                                                                ("[-\./w]*@[/w]*.[/w]*") )        // pas terrible ça !
                                        {
                                                retour=SignalErreur(valeur,formulaire,no_element);
                                               // alert ( retour );
                                               alert (formulaire.elements[no_element].id+" est Incorrect "+retour);
                                                return false;
                                        }
                                        break;
                                //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ une
                                case "nombre":        //~~ nombre ~~~~~~~~~~~~~~~~~~~~~ valeur
                                //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ >= mini et <= maxi
                                 if (   formulaire.elements[no_element].value.length<1 )
                                  {
                                          retour =SignalErreur(valeur,formulaire,no_element);
                                          //alert ( retour );
                                          alert ("Le champ "+formulaire.elements[no_element].id+" est Obligatoire ");
                                          return false;
                                           break;
                                  }
                                        if (isNaN(formulaire.elements[no_element].value))
                                        {
                                                retour=SignalErreur(valeur,formulaire,no_element);
                                               // alert ( retour );
                                               alert ("Le champ "+formulaire.elements[no_element].id+" doit être un nombre ");
                                          		return false;
                                                break;
                                        }
                                        if (valeur["mini"])
                                        {
                                                if (Number(formulaire.elements[no_element].value)<Number(valeur["mini"]))
                                                {
                                                        retour=SignalErreur(valeur,formulaire,no_element);
                                                       // alert.width>20;
                                                        alert ( retour );
                                                       //alert (formulaire.elements[no_element].id+" minimum "+Number(valeur["mini"]));
                                                        /* if ((formulaire.elements[no_element].id=="Numéro Demande Abonnement" || formulaire.elements[no_element].id=="Police")) {
				                                          	//(formulaire.elements[no_element].value.substr(0,3)!=120 || formulaire.elements[no_element].value.substr(0,3)!=125)
				                                            var code=formulaire.elements[no_element].value.substr(0,3);
				                                            //document.write(code.substr(0,3));
				                                            if (parseInt(code)!=120 ) {
				                                                    alert (formulaire.elements[no_element].id+" est Obligatoire minimum 10 chiffres  "+code.substr(0,3));
				                                                    return false;
				                                            }
				                                            else {
				                                               		//alert (formulaire.elements[no_element].id+" est Obligatoire minimum 10chiffres  et doit commencer par 120 ou 125");
				                                            }

				                                          }
				                                          else {
				                                             alert (formulaire.elements[no_element].id+" est Obligatoire ");

				                                          } */
                                                         return false;
                                                        break;
                                                }
                                        }
                                        if (valeur["maxi"])
                                        {
                                                if (Number(formulaire.elements[no_element].value)>Number(valeur["maxi"]))
                                                {
                                                        retour=SignalErreur(valeur,formulaire,no_element);
                                                     alert ( retour );

                                                        return false;
                                                        break;
                                                }
                                        }
                                        break;



                          //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ controle
                          default:        //~~ pas de contrôle alors ? ~~~~~~~~~~~~~~~~~~~~~~~ non traité.
                          //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ enfin pour le moment
                                  break;
                       }
                }
  }
}
