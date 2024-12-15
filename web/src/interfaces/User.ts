import Perfil from "./Perfil";

export default interface User {
  id: string;
  nome: string;
  cpf: string;
  email: string;
  created_at: Date;
  updated_at: Date;
  perfil: Perfil;
}
