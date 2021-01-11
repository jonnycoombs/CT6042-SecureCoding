#include <string.h>
#include <stdio.h>
#include <sys/types.h>
#include <sys/stat.h>
#include <fcntl.h>
#include <errno.h>

// Race Condition (TOCTUO)

int main(int argc, char* argv[]) {
    //Declaring variables
    int fileData;
    int size = 0;
    char buf[256];

    }
//This is the begninng of the exploit as it will check here for info about the file that was given to it 
    struct stat file_info;

//Here this function checks using the data gathered above if the file is root or not
//st_uid hgets the user ID of the owner and 0 means root
    if(file_info.st_uid == 0)
    {
        fprintf(stdout, "Can't open, this file %s is owned by root\n", argv[1]);
        exit(1);
    }
//Opens the file in readonly mode
    fileData = open(argv[1], O_RDONLY);
    // This function checks if the above fileData variable contains a 1 showing the file can open if not then it prints an error
    if(fileData <= 0)
    {
        fprintf(stderr, "Could not open %s\n", argv[1]);
        exit(1);
    }
//This function writes the read file into the bufer and then prints it until size = 0
    do {
        size = read(fileData, buf, 256);
        write(1, buf, size);
    } while(size>0);

}
