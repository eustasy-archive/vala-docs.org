string get_vala_version () {
    string stdout;
    try {
        Process.spawn_command_line_sync ("vala --version", out stdout);
    } catch (SpawnError e) {
        error (e.message);
    }
    return stdout.strip ();
}

string get_vapidir () {
    string stdout, stderr;
    int exit_status;
    try {
        Process.spawn_command_line_sync ("pkg-config --variable=vapidir vapigen", out stdout, out stderr, out exit_status);
    } catch (SpawnError e) {

    }
}

string get_versioned_vapidir () {
    Process.spawn_command_line_sync ("pkg-config --variable=vapidir libvala-%s");
}
