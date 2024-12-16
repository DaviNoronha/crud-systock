export const getHeaders = (perfil: any) => {
  if (perfil.value === "admin") {
    return [
      { title: "Nome", key: "nome", align: "start" },
      { title: "CPF", key: "cpf", align: "end" },
      { title: "E-mail", key: "email", align: "end" },
      { title: "Adicionado em", key: "created_at", align: "end" },
      { title: "Perfil", key: "perfil.descricao", align: "end" },
      { title: "Ações", key: "acoes", align: "end" },
    ];
  }

  return [
    { title: "Nome", key: "nome", align: "start" },
    { title: "CPF", key: "cpf", align: "end" },
    { title: "E-mail", key: "email", align: "end" },
    { title: "Adicionado em", key: "created_at", align: "end" },
    { title: "Perfil", key: "perfil.descricao", align: "end" },
  ];
};
