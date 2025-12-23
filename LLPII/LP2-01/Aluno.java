import java.util.Scanner;
public class Aluno {
    public String nome;
    public int idade;
    public String identidade;
    void defineIdentidade(String valor){
        if(valor.length()>=5){
            identidade = valor;
        } else{
            System.out.println("indentidade invalida");
        }
    }
    String pegaIdentidade(){
            return identidade;
        }
    public static void main(String[] args) {
        Scanner entrada = new Scanner(System.in);
        Aluno aluno1 = new Aluno();
        System.out.println("Digite o nome do aluno: ");
        aluno1.nome = entrada.nextLine();
        System.out.println("Digite a idade do aluno: ");
        aluno1.idade = entrada.nextInt();
        System.out.println("Digite a identidade do aluno: ");
        aluno1.identidade = entrada.nextLine();
        String aux = "";
        aux = entrada.nextLine();
        aluno1.defineIdentidade(aux);
        System.out.println("Nome do aluno: "+aluno1.nome+", de idade: "+aluno1.idade+" e identidade: "+aluno1.pegaIdentidade());
        //aluno2
        Aluno aluno2 = new Aluno();
        System.out.println("Digite o nome do aluno: ");
        aluno2.nome = entrada.nextLine();
        System.out.println("Digite a idade do aluno: ");
        aluno2.idade = entrada.nextInt();
        System.out.println("Digite a identidade do aluno: ");
        aluno2.identidade = entrada.nextLine();
       
        aux = entrada.nextLine();
        aluno2.defineIdentidade(aux);
        System.out.println("Nome do aluno: "+aluno2.nome+", de idade: "+aluno2.idade+" e identidade: "+aluno2.pegaIdentidade());
    }
}
