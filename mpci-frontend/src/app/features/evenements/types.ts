export interface Personne {
  id: string;
  nom: string;
  poste: string;
  photoUrl?: string;
  biographie?: string;
}

export interface Panel {
  id: string;
  titre: string;
  description?: string;
  moderateur?: Personne;
  panelistes: Personne[];
  conferenciers: Personne[];
  date:string;
}

export interface ProgrammeImage {
  programmeImageUrl: string;
}


export interface EvenementDTO {
  id: string;
  titre: string;
  theme: string;
  dateDebut: string;
  dateFin:string;
  ville:string;
  pays:string;
  description?: string;
  adresse?: string;
  imageUrl?: string;
  lienVideo?: string;
  panels: Panel[];
  programmeImages: ProgrammeImage[];
}
  

export interface ParticipationPayload{
  nom: string;
  prenom: string;
  email: string;
  evenement: string;
}