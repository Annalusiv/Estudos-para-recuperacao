import java.io.File;
import java.io.FileNotFoundException;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

public class SubstituiPalavra {
    public static void main(String[] args) {
        // Nome do arquivo definido diretamente no código
        String nomeArquivo = "Metal Contra as Nuvens.txt"; 
        Scanner teclado = new Scanner(System.in);

        System.out.print("Digite a palavra a ser pesquisada: ");
        String busca = teclado.nextLine();
        System.out.print("Digite a nova palavra: ");
        String substituta = teclado.nextLine();

        List<String> conteudoCompleto = new ArrayList<>();

        // 1. Ler o arquivo para a memória e fazer a substituição [cite: 2]
        try (Scanner leitor = new Scanner(new File(nomeArquivo))) {
            while (leitor.hasNextLine()) {
                String linha = leitor.nextLine();
                conteudoCompleto.add(linha.replace(busca, substituta));
            }
        } catch (FileNotFoundException e) {
            System.out.println("Erro: O arquivo '" + nomeArquivo + "' não foi encontrado.");
            return;
        }

        // 2. Salvar o arquivo alterado [cite: 2]
        try (PrintWriter escritor = new PrintWriter(new File(nomeArquivo))) {
            for (String linha : conteudoCompleto) {
                escritor.println(linha);
            }
            System.out.println("Sucesso! O arquivo foi atualizado.");
        } catch (FileNotFoundException e) {
            System.out.println("Erro ao tentar salvar o arquivo.");
        }
    }
}