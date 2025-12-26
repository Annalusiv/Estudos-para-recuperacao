import java.io.File;
import java.io.FileNotFoundException;
import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

public class PesquisaArquivo {
    public static void main(String[] args) {
        // Nome do arquivo definido diretamente no código
        String nomeArquivo = "Metal Contra as Nuvens.txt"; 
        
        Scanner teclado = new Scanner(System.in);
        System.out.print("Digite a palavra a ser procurada: ");
        String palavraProcurada = teclado.nextLine();

        List<Integer> linhasEncontradas = new ArrayList<>();

        try (Scanner leitorArquivo = new Scanner(new File(nomeArquivo))) {
            int numeroLinha = 1;
            while (leitorArquivo.hasNextLine()) {
                String linha = leitorArquivo.nextLine();
                // Verifica se a palavra está na linha 
                if (linha.toLowerCase().contains(palavraProcurada.toLowerCase())) {
                    linhasEncontradas.add(numeroLinha);
                }
                numeroLinha++;
            }

            if (linhasEncontradas.isEmpty()) {
                System.out.println("A palavra '" + palavraProcurada + "' não foi encontrada.");
            } else {
                System.out.print("A palavra " + palavraProcurada + " aparece nas linhas: ");
                System.out.println(linhasEncontradas.toString().replace("[", "").replace("]", ""));
            }

        } catch (FileNotFoundException e) {
            System.out.println("Erro: O arquivo '" + nomeArquivo + "' não foi encontrado na pasta do projeto.");
        }
    }
}
