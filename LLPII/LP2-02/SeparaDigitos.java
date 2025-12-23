import java.util.Scanner;

public class SeparaDigitos {
    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);

        System.out.print("Digite um número de cinco dígitos: ");
        int numero = input.nextInt();

        // Lógica para separar os dígitos
        int d1 = numero / 10000;
        int d2 = (numero % 10000) / 1000;
        int d3 = (numero % 1000) / 100;
        int d4 = (numero % 100) / 10;
        int d5 = numero % 10;

        // Imprime com três espaços entre cada um
        System.out.printf("%d   %d   %d   %d   %d%n", d1, d2, d3, d4, d5);
    }
}