#include <string.h>
#include <stdio.h>
#include <sys/types.h>
#include <sys/stat.h>
#include <fcntl.h>
#include <errno.h>

// Race Condition (TOCTUO)

int main(int argc, char* argv[]) {
// Declaring Variables
    int fileData;
    int size = 0;
    char buf[256];

    
//The below line was moved from the bottom so that the file is opened before it is checked if it is owned by root
// This prevents the ability for a time-of-check to time-of-use race condtion to occur
    fileData = open(argv[1], O_RDONLY);

    //This function checks if the above fileData variable contains the open file if not then it prints an error
    if(fileData <= 0)
    {
        fprintf(stdout, "Couldn't open %s\n", argv[1]);
        exit(1);
    }

	struct stat file_info;

//This function checks if the file is owned by root
//st_uid hgets the user ID of the owner and 0 means root
    if(file_info.st_uid == 0)
    {
        fprintf(stdout, "Can't open, this file %s is owned by root\n", argv[1]);
        exit(1);
    }

//This function writes the read file into the buffer and then prints it until size = 0
    do {
        size = read(fileData, buf, 256);
        write(1, buf, size);
    } while(size>0);

}
