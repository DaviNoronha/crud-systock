export const validateEmail = [
    (v: string) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v) || "E-mail inválido",
];

export const validatePassword = [
    (v: string) => (v && v.length >= 8) || 'Senha precisa ter ao menos 8 caracteres',
];

export const validateNome = [
    (v: string) => !!v || 'O campo Nome é obrigatório.',
];

export const validateCPF = [
    (v: string) => !!v || 'O campo CPF é obrigatório.',
    (v: string) => (v && v.length >= 14) || 'CPF precisa ter ao menos 14 caracteres',
];

export const validatePerfil = [
    (v: string) => !!v || 'O campo Perfil é obrigatório.',
];