import java.util.*;
 
public class look{
     
    static int size = 8; 
    static int disk_size = 200;
    static Scanner read = new Scanner(System.in);
    
    public static void SCAN(int cilin_ini, int peticiones[], int num_peticiones) {
        int  totalDespla = 0, totalTiempo = 0,contMayor=0, contMenor=0, cont=0,desicion=0;
        int datos[][];
        Integer mayor[];
        Integer menor[];
        int todos[];
        
        Vector left = new Vector();
        Vector right = new Vector();
           
        System.out.print("Ingresa el bite ya sea 1 o 0: ");
        desicion=read.nextInt();
        
        for (int i = 0; i < num_peticiones; i++) {
            if (peticiones[i] < cilin_ini) {
                left.add(peticiones[i]);
                contMenor++;
            }
            if (peticiones[i] > cilin_ini) {
                right.add(peticiones[i]);
                contMayor++;
            }
        }
        Collections.sort(left);
        Collections.sort(right);
        
        menor = new Integer[contMenor];
        mayor = new Integer[contMayor];
        
       
        todos = new int[contMenor+contMayor];
        datos = new int [4][todos.length];
        
        for (int i =0; i < contMenor; i++) {
            menor[i] = (Integer) left.elementAt(i);
        }
              
        Arrays.sort(menor, Collections.reverseOrder());
        
        
        for(int i=0; i<contMayor; i++){
            mayor[i] = (Integer) right.elementAt(i);
        }
        Arrays.sort(mayor, Collections.reverseOrder());
        if (desicion == 1) {
            for (int i = 0; i < contMenor; i++) {
                todos[i] = menor[i];
                cont++;
            }
            for (int i = 0; i < contMayor; i++) {
                todos[i + cont] = mayor[i];
            }

            for (int i = 0; i < todos.length; i++) {
                if (i == 0) {
                    datos[0][i] = cilin_ini;
                    datos[1][i] = todos[i];
                    datos[2][i] = 0;
                    int aux = cilin_ini - todos[i];
                    if (aux < 0) {
                        datos[3][i] = aux * (-1);
                    } else {
                        datos[3][i] = aux;
                    }

                } else {
                    datos[0][i] = todos[i - 1];
                    datos[1][i] = todos[i];
                    datos[2][i] = datos[2][i - 1] + datos[3][i - 1];
                    int aux = datos[0][i] - datos[1][i];
                    if (aux < 0) {
                        datos[3][i] = aux * (-1);
                    } else {
                        datos[3][i] = aux;
                    }
                }
            }
        }
        if (desicion == 0) {

            for (int i = 0; i < contMayor; i++) {
                todos[i] = mayor[i];
            }
            for (int i = 0; i < contMenor; i++) {
                todos[i+ cont] = menor[i];
                cont++;
            }

            for (int i = 0; i < todos.length; i++) {
                System.out.println(todos[i]);
            }

            for (int i = 0; i < todos.length; i++) {
                if (i == 0) {
                    datos[0][i] = cilin_ini;
                    datos[1][i] = todos[i];
                    datos[2][i] = 0;
                    int aux = cilin_ini - todos[i];
                    if (aux < 0) {
                        datos[3][i] = aux * (-1);
                    } else {
                        datos[3][i] = aux;
                    }

                } else {
                    datos[0][i] = todos[i - 1];
                    datos[1][i] = todos[i];
                    datos[2][i] = datos[2][i - 1] + datos[3][i - 1];
                    int aux = datos[0][i] - datos[1][i];
                    if (aux < 0) {
                        datos[3][i] = aux * (-1);
                    } else {
                        datos[3][i] = aux;
                    }
                }
            }
        }
        
       
       
       System.out.printf("\n%-10s %-10s %-10s %-10s \n", "Cilindro Actual", "Cilindro solicitado", "Tiempo de espera", "Desplazamiento");
        for (int i = 0; i < todos.length; i++) {
            System.out.printf(" %-17d %-20d %-17d %-15d \n", datos[0][i], datos[1][i], datos[2][i], datos[3][i]);
        }
        for (int i = 0; i < todos.length; i++) {
            totalTiempo += datos[2][i];
            totalDespla += datos[3][i];
        }
        System.out.printf("\nDesplazamiento: %d\n", totalDespla);
        System.out.printf("Tiempo promedio de espera: %.3f\n", (double) totalTiempo / num_peticiones);
    }

    public static void CSCAN(int cilin_ini, int peticiones[], int num_peticiones) {
        int totalDespla = 0, totalTiempo = 0,contMayor=0, contMenor=0, cont=0, bControl=0;
        int datos[][];
        Integer mayor[];
        Integer menor[];
        int todos[];
        
        Vector left = new Vector();
        Vector right = new Vector();
        
        
        System.out.print("Ingrese el bit de Control [0 o 1]: ");     
        bControl = read.nextInt();
        
        for (int i = 0; i <num_peticiones; i++) {
            if (peticiones[i] < cilin_ini) {
                left.add(peticiones[i]);
                contMenor++;
            }
            if (peticiones[i] > cilin_ini) {
                right.add(peticiones[i]);
                contMayor++;
            }
        }
        
        Collections.sort(left);
        Collections.sort(right, Collections.reverseOrder());
        
        menor = new Integer[contMenor];
        mayor = new Integer[contMayor];

        todos = new int[contMenor+contMayor];
        datos = new int [4][todos.length];

        int run = 2;
        while (run-- >0){
            if (bControl == 0) {
                for (int i = contMenor - 1; i >= 0; i--){
                    menor [i] = (Integer) left.elementAt(i);
                }
                Arrays.sort(menor, Collections.reverseOrder());
                bControl = 1;
            }
            else if (bControl == 1) 
            {
                for (int i = 0; i < contMayor; i++) 
                {
                    mayor[i] = (Integer) right.elementAt(i);
                }
                bControl = 0;
            }
        }

       for(int i=0; i<contMenor;i++){
            todos[i]=menor[i];
            cont++;
        }
        for(int i=0; i<contMayor;i++){
            todos[i+cont]=mayor[i];
        }
         //codigo pinky    
        if (bControl == 0) {
            for (int i = 0; i < todos.length; i++) {
                if (i == 0) {
                    datos[0][i] = cilin_ini;
                    datos[1][i] = todos[i];
                    datos[2][i] = 0;
                    int aux = cilin_ini - todos[i];
                    if (aux < 0) {
                        datos[3][i] = aux * (-1);
                    } else {
                        datos[3][i] = aux;
                    }

                } else {
                    datos[0][i] = todos[i - 1];
                    datos[1][i] = todos[i];
                    datos[2][i] = datos[2][i - 1] + datos[3][i - 1];
                    int aux = datos[0][i] - datos[1][i];
                    if (aux < 0) {
                        datos[3][i] = aux * (-1);
                    } else {
                        datos[3][i] = aux;
                    }
                }
            }
        }
        if (bControl == 1) {

            for (int i = 0; i < contMayor; i++) {
                todos[i] = mayor[i];
            }
            for (int i = 0; i < contMenor; i++) {
                todos[i+cont] = menor[i];
                cont++;
            }

            for (int i = 0; i < todos.length; i++) {
                if (i == 0) {
                    datos[0][i] = cilin_ini;
                    datos[1][i] = todos[i];
                    datos[2][i] = 0;
                    int aux = cilin_ini - todos[i];
                    if (aux < 0) {
                        datos[3][i] = aux * (-1);
                    } else {
                        datos[3][i] = aux;
                    }

                } else {
                    datos[0][i] = todos[i - 1];
                    datos[1][i] = todos[i];
                    datos[2][i] = datos[2][i - 1] + datos[3][i - 1];
                    int aux = datos[0][i] - datos[1][i];
                    if (aux < 0) {
                        datos[3][i] = aux * (-1);
                    } else {
                        datos[3][i] = aux;
                    }
                }
            }
        }
       System.out.printf("\n%-10s %-10s %-10s %-10s \n", "Cilindro Actual", "Cilindro solicitado", "Tiempo de espera", "Desplazamiento");
        for (int i = 0; i < todos.length; i++) {
            System.out.printf(" %-17d %-20d %-17d %-15d \n", datos[0][i], datos[1][i], datos[2][i], datos[3][i]);
        }
        for (int i = 0; i < todos.length; i++) {
            totalTiempo += datos[2][i];
            totalDespla += datos[3][i];
        }
        System.out.printf("\nDesplazamiento: %d\n", totalDespla);
        System.out.printf("Tiempo promedio de espera: %.3f\n", (double) totalTiempo /num_peticiones);
    }
    
    // Driver code
    public static void main(String[] args) throws Exception 
    {
        
        // Request array 
        int arr[] = {98,183,37,122,14,124,65,67}; 
        int head = 53; 
        

    
        CSCAN(head, arr, arr.length); 
    }
}