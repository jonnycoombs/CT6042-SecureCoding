#include <stdio.h>
#include <ctype.h>

#define MAX 32

int main(void) {

    char caps[MAX],input='\0';

    int i=0;

    printf("Enter a string: ");

    while(input!='\n') {

      input=getc(stdin);

      if(i<(MAX-1)) {

        caps[i]=toupper(input);

        i++;
      }
    }
 
   printf("%s",caps);

    return 0;

}
