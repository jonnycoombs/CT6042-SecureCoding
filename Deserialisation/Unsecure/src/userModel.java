/**
 * Created on 03/12/2020
 * @author Jonathan Coombs s1704616@glos.ac.uk
 */

import java.io.ObjectInputStream;
import java.io.Serializable;

public class userModel implements Serializable {

    String firstName;
    String lastName;
    String email;

    private void readObj(ObjectInputStream in){

    }
}
