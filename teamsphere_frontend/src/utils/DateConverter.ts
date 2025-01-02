export const formatDate = (dateStr: string | Date | null | undefined): string => {
  if( !dateStr || dateStr == null || dateStr == undefined){
    return ""
  }
  const date = new Date(dateStr);

  const options: Intl.DateTimeFormatOptions = {
    weekday: 'long',
    day: 'numeric',
    month: 'long',
    year: 'numeric',
  };

  return date.toLocaleDateString('fr-FR', options);
}

export const formatDateEtHeure = (chaineDate:string | Date | null | undefined) => {
  if (chaineDate == null || chaineDate == undefined) {
    return ""
  }
  const date = new Date(chaineDate);


  const heureFormatee = new Intl.DateTimeFormat('fr-FR', {
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit',
    hour12: false,
  }).format(date);

  return heureFormatee ;
};

export const formatDateEtHeureDeux = (chaineDate: string | Date | null | undefined) => {
  if (chaineDate == null || chaineDate == undefined) {
    return ""
  }
  const date = new Date(chaineDate);

  const dateFormatee = new Intl.DateTimeFormat('fr-FR', {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
  }).format(date);



  return dateFormatee;
};




