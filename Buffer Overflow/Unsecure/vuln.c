#include <stdio.h>
#include <string.h>
#include <ctype.h>

void stringUpr(char *s){
	int len,i;
	len=strlen(s);

	for(i=0;i<len;i++)
		s[i]=toupper(s[i]);
}
int main (int argc, char* argv[1])
{
	char buffer[500];
	strcpy(buffer, argv[1]);
	stringUpr(argv[1]);
	printf("Uppercase version of your input is: %s\n",argv[1]);
	return 0;
}
