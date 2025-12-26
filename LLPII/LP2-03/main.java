import java.io.*;
import java.util.ArrayList;
import java.util.Scanner;

public class main {
    private static final String ARQUIVO = "alunos.csv";

    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        int opcao = 0;

        do {
            System.out.println("\n--- SISTEMA DE ALUNOS ---");
            System.out.println("1. Cadastrar Novo Aluno (Adicionar ao arquivo)");
            System.out.println("2. Listar Alunos do Arquivo");
            System.out.println("0. Sair");
            System.out.print("Escolha uma opção: ");
            opcao = sc.nextInt();
            sc.nextLine(); // Limpar buffer

            switch (opcao) {
                case 1:
                    cadastrarAluno(sc);
                    break;
                case 2:
                    listarAlunos();
                    break;
                case 0:
                    System.out.println("Saindo...");
                    break;
                default:
                    System.out.println("Opção inválida!");
            }
        } while (opcao != 0);

        sc.close();
    }

    // --- FUNÇÃO PARA ADICIONAR DADOS AO ARQUIVO ---
    public static void cadastrarAluno(Scanner sc) {
        System.out.print("Matrícula: ");
        int mat = sc.nextInt();
        sc.nextLine();
        System.out.print("Nome: ");
        String nome = sc.nextLine();
        System.out.print("Email: ");
        String email = sc.nextLine();
        System.out.print("Senha: ");
        String senha = sc.nextLine();
        System.out.print("Turma: ");
        String turma = sc.nextLine();

        Aluno novo = new Aluno(mat, nome, email, senha, turma);

        // 'true' no FileWriter permite adicionar sem apagar o que já existe
        try (PrintWriter writer = new PrintWriter(new FileWriter(ARQUIVO, true))) {
            // Se o arquivo estiver vazio, pode-se criar um cabeçalho aqui se desejar
            writer.println(novo.getMatricula() + "," + novo.getNome() + "," + 
                           novo.getEmail() + "," + novo.getSenha() + "," + novo.getTurma());
            System.out.println("Aluno salvo com sucesso no arquivo!");
        } catch (IOException e) {
            System.err.println("Erro ao salvar: " + e.getMessage());
        }
    }

    // --- FUNÇÃO PARA LER DO ARQUIVO E ADICIONAR NA COLETÂNEA ---
    public static void listarAlunos() {
    ArrayList<Aluno> lista = new ArrayList<>();
    
    try (BufferedReader br = new BufferedReader(new FileReader(ARQUIVO))) {
        String linha;
        
        // --- ADICIONE ESTA LINHA ABAIXO ---
        String cabecalho = br.readLine(); // Isso consome a primeira linha (o texto)
        
        while ((linha = br.readLine()) != null) {
            String[] dados = linha.split(",");
            if (dados.length >= 5) {
                // Agora o parseInt só vai pegar os números das linhas seguintes
                int mat = Integer.parseInt(dados[0].trim());
                lista.add(new Aluno(mat, dados[1], dados[2], dados[3], dados[4]));
            }
        }

        System.out.println("\n--- ALUNOS CARREGADOS DO ARQUIVO ---");
        for (Aluno a : lista) {
            System.out.println(a);
        }
    } catch (FileNotFoundException e) {
        System.out.println("Arquivo ainda não existe.");
    } catch (IOException e) {
        System.err.println("Erro ao ler arquivo: " + e.getMessage());
    }
}
}