import java.io.File;
import java.io.FileNotFoundException;
import java.util.ArrayList;
import java.util.Scanner;

class Funcionario{
    String nome, email, cargo, turma, setor, senha;
    int matricula;
    //CONSTRUTOR
    public Funcionario(int matricula, String nome, String email, String senha, String cargo, String turma, String setor){
        this.matricula = matricula;
        this.nome = nome;
        this.email = email;
        this.senha = senha;
        this.cargo = cargo;
        this.turma = turma;
        this.setor = setor;
    }
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
    //CARGO
    String getCargo(){
        return cargo;
    }
    String setCargo(String cargo){
        return this.cargo = cargo;
    }
    //TURMA
    String getTurma(){
        return turma;
    }
    String setTurma(String turma){
        return this.turma = turma;
    }   
    //SETOR
    String getSetor(){
        return setor;
    }
    String setSetor(String setor){
        return this.setor = setor;
    }

    public String toString(){
        String senhaAsteriscos = "*".repeat(senha.length());//PRA ESCONDER A SENHA EM ASTERISCOS
        return "\nMatricula: " + matricula + ", Nome: " + nome + ", Email: " + email + ", Senha: " + senhaAsteriscos + ", Cargo: " + cargo + ", Turma: " + turma + ", Setor: " + setor;
    }
     public static void main(String[] args) {
       ArrayList<Funcionario> listaFuncionarios = new ArrayList<>();
        File arquivo = new File("pessoal.csv"); 

        try (Scanner leitor = new Scanner(arquivo)) {
            // Pula o cabeçalho: matrícula;nome;email;senha;cargo;turma;setor 
            if (leitor.hasNextLine()) {
                leitor.nextLine();
            }

            while (leitor.hasNextLine()) {
                String linha = leitor.nextLine();
                
                // Limpeza: remove marcações de source e pula linhas vazias [cite: 2, 3]
                if (linha.startsWith("[source") || linha.trim().isEmpty()) {
                    continue;
                }

                String[] dados = linha.split(";", -1); // O -1 mantém colunas vazias

                if (dados.length >= 6) {
                    try {
                        int mat = Integer.parseInt(dados[0].trim());
                        String nome = dados[1];
                        String email = dados[2];
                        String senha = dados[3];
                        String cargo = dados[4];
                        String turma = dados[5];
                        // Tratamento para evitar erro se a última coluna (setor) estiver ausente
                        String setor = (dados.length > 6) ? dados[6] : "";

                        listaFuncionarios.add(new Funcionario(mat, nome, email, senha, cargo, turma, setor));
                    } catch (NumberFormatException e) {
                        // Ignora linhas onde a matrícula não é um número válido
                    }
                }
            }

            System.out.println("======= RELATÓRIO DE PESSOAL =======");
            for (Funcionario f : listaFuncionarios) {
                // Aqui o Java chama o seu método toString() automaticamente 
                System.out.println(f);
            }
            System.out.println("\nTotal de registros: " + listaFuncionarios.size());

        } catch (FileNotFoundException e) {
            System.err.println("Erro: O arquivo pessoal.csv não foi encontrado.");
        }
    }
}