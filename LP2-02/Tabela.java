public class Tabela {
    public static void main(String[] args) {
        System.out.println("Numero\tQuadrado\tCubo"); 

        for (int i = 0; i <= 10; i++) { 
            int quadrado = i * i;
            int cubo = i * i * i;
            System.out.printf("%d\t%d\t\t%d%n", i, quadrado, cubo); 
        }
    }
}