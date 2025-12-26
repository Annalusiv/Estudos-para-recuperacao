class Aluno{
    String nome, email, cargo, turma, setor, senha;
    int matricula;
    //CONSTRUTOR
    public Aluno(int matricula, String nome, String email, String senha, String turma){
        this.matricula = matricula;
        this.nome = nome;
        this.email = email;
        this.senha = senha;
        this.turma = turma;
    }
    /* */
    //GETTERS E SETTERS
    //MATRICULA
    int getMatricula(){
        return matricula;
    }
    int setMatricula(int matricula){
        return this.matricula = matricula;
    }
    //NOME
    String getNome(){
        return nome;
    }
    String setNome(String nome){
        return this.nome = nome;
    }
    //EMAIL
    String getEmail(){
        return email;
    }
    String setEmail(String email){
        return this.email = email;
    }
    //SENHA
    String getSenha(){
        return senha;
    }
    String setSenha(String senha){
        return this.senha = senha;
    }
    //TURMA
    String getTurma(){
        return turma;
    }
    String setTurma(String turma){
        return this.turma = turma;
    }

    public String toString(){
        String senhaAsteriscos = "*".repeat(senha.length());//PRA ESCONDER A SENHA EM ASTERISCOS
        return "ALUNO: \nMatricula: " + matricula + ", Nome: " + nome + ", Email: " + email + ", Senha: " + senhaAsteriscos + ", Turma: " + turma;
    }
}
