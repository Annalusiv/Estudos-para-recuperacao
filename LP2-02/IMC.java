import java.util.Scanner;

public class IMC {
    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);

        System.out.print("Digite seu peso em quilogramas: ");
        float peso = input.nextFloat(); 

        System.out.print("Digite sua altura em metros: ");
        float altura = input.nextFloat(); 

        float imc = peso / (altura * altura); 

        System.out.printf("%nSeu IMC é: %.2f%n%n", imc);
        System.out.println("VALORES IMC:");
        System.out.println("MAGREZA:   MENOR QUE 18,5"); 
        System.out.println("NORMAL:    ENTRE 18,5 E 24,9"); 
        System.out.println("SOBREPESO: ENTRE 25,0 E 29,9"); 
        System.out.println("OBESIDADE: 30,0 OU MAIOR"); 
    }
}
